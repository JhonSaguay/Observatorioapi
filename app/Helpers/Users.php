<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Status;
use App\Models\UserBranchOffice;
use App\Models\UserOrganization;
use App\Models\UsersRoles;
use App\User;
use Carbon\Carbon;
use Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Users
{
    /**
     * @param User $user
     * @return bool
     */
    public static function userAdmin(User $user)
    {
        if ($user->license()->count() > 0) {
            if (!Helper::validateAdmin($user)) {
                $rolAdmin = Role::getRoleAdmin();
                if (!RoleUser::create(['user_id' => $user->id, 'role_id' => $rolAdmin->id])) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function validateUser($user)
    {
        $user = is_object($user) ? $user : User::find($user);
        $status = Status::getStatusApproved();

        if ($user->userRoles) {
            foreach ($user->userRoles as $userRol) {
                if ($userRol->rol && $userRol->rol->name == 'user' && $status->id == $userRol->status_id) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function validateAdmin($user)
    {
        $user = is_object($user) ? $user : User::find($user);
        $status = Status::getStatusApproved();

        if ($user->userRoles) {
            foreach ($user->userRoles as $userRol) {
                if ($userRol->rol && $userRol->rol->name == 'admin' && $status->id == $userRol->status_id) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param $user
     * @return bool
     */
    public static function validateSuperAdmin($user)
    {
        $status = Status::getStatusApproved();
        if ($user->userRoles) {
            foreach ($user->userRoles as $userRol) {
                if ($userRol->rol && $userRol->rol->name == 'superadmin' && $status->id == $userRol->status_id) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function userDoctor(User $user)
    {
        DB::statement('call insert_user_organization(?)', [$user->id]);
        /*
        foreach ($user->doctor as $doctor) {
            foreach ($doctor->userDocOffice as $docOffice) {
                $data = [
                    'user_id' => $doctor->id_usr,
                    'office_id' => $docOffice->id_office,
                ];

                if (UserBranchOffice::where($data)->count() <= 0) {
                    $userOffice = UserBranchOffice::create($data);
                }
            }
        }
        */
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function validateActive()
    {
        return count(self::getRolesSession());
    }

    /**
     * @return mixed
     */
    public static function getRolesSession()
    {
        return session()->get('roles') ?? [];
    }

    public static function setRolesSession()
    {
        $rolesUser = UsersRoles::getRolesUser(Auth::user())->pluck('roles_name', 'roles_id')->all();
        session()->put('roles', $rolesUser);
    }

    /**
     * @return mixed
     */
    public static function getRolesSessionString()
    {
        $roles = session()->get('roles') ?? [];
        return implode(',', $roles);
    }

    /**
     * @param User $user
     * @return array
     */
    public static function getUsersFromUser(User $user)
    {
        if (self::validateAdmin($user)) {
            $organizations = UserOrganization::getUserOrganizationsUser($user)->pluck('organization_id', 'organization_id')->all();
            return UserOrganization::getUserOrganizations($organizations)->pluck('user_id', 'user_id')->all();
        }

        if (self::validateUser($user)) {
            return UserOrganization::getUserOrganizationsUser($user)->pluck('user_id', 'user_id')->all();
        }

        if (self::validateSuperAdmin($user)) {
            return User::get()->pluck('id', 'id')->all();
        }
    }

    /**
     * @param User $user
     * @return array
     */
    public static function getOfficesFromUser(User $user)
    {
        $users = Users::getUsersFromUser($user);
        return UserOrganization::getUserOrganizationsUser($users)->pluck('office_id', 'office_id')->all();
    }

    /**
     * @param User $user
     * @return array
     */
    public static function getOrganizationFromUser(User $user)
    {
        $users = Users::getUsersFromUser($user);
        return UserOrganization::getUserOrganizationsUser($users)->pluck('organization_id', 'organization_id')->all();
    }

}
