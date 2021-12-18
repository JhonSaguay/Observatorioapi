<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\UserBranchOffice;
use App\User;
use Carbon\Carbon;
use Config;

class Helper
{

    /**
     * @param string $fecha
     * @param string $format
     * @return string
     */
    public static function formatDate($fecha, $format = 'M d Y')
    {
        return ($fecha) ? Carbon::parse($fecha)->format($format) : null;
    }

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return object
     */
    public static function getDateFilter($selectStartDate, $selectEndDate)
    {
        $selectStartDate = is_object($selectStartDate) ? $selectStartDate : (new Carbon($selectStartDate));
        $selectEndDate = is_object($selectEndDate) ? $selectEndDate : (new Carbon($selectEndDate));

        $diff = $selectStartDate->diff($selectEndDate);

        $data = [
            'date_start' => $selectStartDate,
            'date_end' => $selectEndDate,
            'days' => (($diff->h > 0 || $diff->i > 0) && $diff->days < 31) ? ($diff->days + 1) : $diff->days,
        ];

        return (object)$data;
    }

    /**
     * @param $estado
     * @return string
     */
    public static function getLabelStatus($status)
    {
        if ($status) {
            return '<span class="badge badge-danger">ELIMINADO</span>';
        } else {
            return '<span class="badge badge-success">ACTIVO</span>';
        }
    }

    /**
     * @param $estado
     * @return string|null
     */
    public static function getLabelStatusName($status)
    {
        $status = mb_strtolower($status);
        if ($status == 'inactive') {
            return '<span class="badge badge-warning">INACTIVO</span>';
        } else if ($status == 'active') {
            return '<span class="badge badge-success">ACTIVO</span>';
        } else if ($status == 'review') {
            return '<span class="badge badge-warning">PENDIENTE</span>';
        } else if ($status == 'approved') {
            return '<span class="badge badge-success">APROBADO</span>';
        }

        return null;
    }

    /**
     * @return null|object
     */
    public static function defaultDateFilter()
    {
        if (!Session::has('filter')) {
            $startDate = new Carbon('last sunday +1days');
            $endDate = new Carbon('next sunday');
            $diff = $startDate->diff($endDate);


            $startDate_ = (clone $startDate)->subDays(($diff->days + 1));
            $endDate_ = (clone $startDate_)->addDays(($diff->days));

            return self::getDateFilter($startDate, $endDate, $startDate_, $endDate_);
        }

        return null;
    }

    /**
     * @param $date_start
     * @param $date_end
     * @return Carbon[]
     */
    public static function getListDatesFilter($date_start, $date_end)
    {
        $dates = [];
        if (($dateStart = self::getDateFilter($date_start, $date_end)) && $dateStart) {
            for ($day = 0; $day <= $dateStart->days; $day++) {
                $date = (clone $dateStart->date_start)->addDays($day);
                $dates[] = $date;
            }
        }

        return collect($dates);
    }

    /**
     * @param $dateStart Carbon
     * @param $dateEnd Carbon
     * @param $interval
     */
    public static function getListDatesHoursFilter($dateStart, $dateEnd, $interval)
    {
        $dates = [];
        $interval_ = self::getArrayTimeFormat($interval);


        for (; $dateStart->lte($dateEnd);) {
            $dates[] = $dateStart->copy();

            $dateStart
                ->addRealHours($interval_['h'])
                ->addMinutes($interval_['i'])
                ->addSeconds($interval_['s']);
        }

        return collect($dates);
    }


    /**
     * @return \ArrayObject
     */
    public static function returnDays()
    {
        $weekDays = new \ArrayObject([]);
        $weekDays->append((new \ArrayObject([
            'name' => 'Lunes',
            'key' => 1,
            'series' => 0,
            'detail' => (new \ArrayObject([])),
            'detail_hours' => (new \ArrayObject([])),
        ])));

        $weekDays->append((new \ArrayObject([
            'name' => 'Martes',
            'key' => 2,
            'series' => 0,
            'detail' => (new \ArrayObject([])),
            'detail_hours' => (new \ArrayObject([])),
        ])));

        $weekDays->append((new \ArrayObject([
            'name' => 'Miercoles',
            'key' => 3,
            'series' => 0,
            'detail' => (new \ArrayObject([])),
            'detail_hours' => (new \ArrayObject([])),
        ])));

        $weekDays->append((new \ArrayObject([
            'name' => 'Jueves',
            'key' => 4,
            'series' => 0,
            'detail' => (new \ArrayObject([])),
            'detail_hours' => (new \ArrayObject([])),
        ])));

        $weekDays->append((new \ArrayObject([
            'name' => 'Viernes',
            'key' => 5,
            'series' => 0,
            'detail' => (new \ArrayObject([])),
            'detail_hours' => (new \ArrayObject([])),
        ])));

        $weekDays->append((new \ArrayObject([
            'name' => 'Sabado',
            'key' => 6,
            'series' => 0,
            'detail' => (new \ArrayObject([])),
            'detail_hours' => (new \ArrayObject([])),
        ])));

        $weekDays->append((new \ArrayObject([
            'name' => 'Domingo',
            'key' => 0,
            'series' => 0,
            'detail' => (new \ArrayObject([])),
            'detail_hours' => (new \ArrayObject([])),
        ])));

        return $weekDays;
    }

    /**
     * @return \ArrayObject
     */
    public static function returnHours()
    {
        $weekDays = new \ArrayObject([]);
        for ($i = 0; $i < 24; $i++) {
            $nameHour = str_pad($i, 2, "0", STR_PAD_LEFT);
            $weekDays->append((new \ArrayObject([
                'name' => "{$nameHour}:00",
                'key' => $i,
                'arr' => [$i, 0],
                'traffic' => 0
            ])));

            $weekDays->append((new \ArrayObject([
                'name' => "{$nameHour}:30",
                'key' => floatval("{$i}.3"),
                'arr' => [$i, 3],
                'traffic' => 0
            ])));
        }

        return $weekDays;
    }

    /**
     * @return string
     */
    public static function refLicensePayment()
    {
        return 'REF-LIC-' . date('YmdHis');
    }

    /**
     * @return string
     */
    public static function refAppointmentPayment()
    {
        return 'REF-APP-' . date('YmdHis');
    }

    /**
     * @param $fecha
     * @return bool|mixed|null|string|string[]
     */
    public static function getFieldDay($fecha)
    {
        return mb_strtolower(self::formatDate($fecha, 'D'));
    }

    /**
     * @param $time
     * @return array
     */
    public static function getArrayTimeFormat($time)
    {
        if ($time && $data = explode(':', $time) ?? []) {
            return [
                'h' => (isset($data[0])) ? trim($data[0]) : '00',
                'i' => (isset($data[1])) ? trim($data[1]) : '00',
                's' => (isset($data[2])) ? trim($data[2]) : '00',
            ];
        }

        return null;
    }

    /**
     * @param $time
     * @return array
     */
    public static function getArrayTimeHHMM($time)
    {
        if ($time = self::getArrayTimeFormat($time)) {
            return $time['h'] . ':' . $time['i'];
        }

        return null;
    }

    /**
     * @param $time
     * @return array
     */
    public static function getArrayTimePicker($time)
    {
        if ($time && $data = explode(':', $time) ?? []) {
            return [(int)$data[0], (int)$data[1]];
        }

        return [0, 0];
    }

    public static function statusPayment()
    {
        return [
            0 => 'Waiting for Payment.',
            1 => 'Verification required, please see Verification section.',
            3 => 'Pago realizado exitosamente, por favor verifique su email para recibir el código de confirmación.',
            6 => 'Fraud.',
            7 => 'Refund.',
            8 => 'Chargeback',
            9 => 'Rejected by carrier.',
            10 => 'System error.',
            11 => 'Paymentez fraud.',
            12 => 'Paymentez blacklist.',
            13 => 'Time tolerance.',
            14 => 'Expired by Paymentez',
            15 => 'Expired by carrier.',
            19 => 'Invalid Authorization Code.',
            20 => 'Authorization code expired.',
            21 => 'Paymentez Fraud - Pending refund.',
            22 => 'Invalid AuthCode - Pending refund.',
            23 => 'AuthCode expired - Pending refund.',
            24 => 'Paymentez Fraud - Refund requested.',
            25 => 'Invalid AuthCode - Refund requested.',
            26 => 'AuthCode expired - Refund requested.',
            27 => 'Merchant - Pending refund.',
            28 => 'Merchant - Refund requested.',
            29 => 'Annulled.',
            30 => 'Transaction seated (only Ecuador).',
            31 => 'Waiting for OTP.',
            32 => 'OTP successfully validated.',
            33 => 'OTP not validated.',
            34 => 'Partial refund.',
            35 => '3DS method requested, waiting to continue.',
            36 => '3DS challenge requested, waiting CRES.',
            37 => 'Rejected by 3DS.',
        ];
    }

    /**
     * @param int $total
     * @param int $cantidad
     * @return float|int
     */
    public static function getPorcenCant($total, $cantidad, $int = false)
    {
        $percent = ($cantidad * 100) / $total;

        return ($int) ? round($percent) : $percent;
    }

    /**
     * @param $total_from
     * @param $total_to
     * @return float|int|null
     */
    public static function calculateIncrement($total_from, $total_to)
    {
        if ($total_from > 0) {
            return (100 * ($total_to - $total_from)) / $total_from;
        }

        return null;
    }

    /**
     * @return array
     */
    public static function applClasses()
    {
        // Demo
        // $fullURL = request()->fullurl();
        // if (App()->environment() === 'production') {
        //     for ($i = 1; $i < 7; $i++) {
        //         $contains = Str::contains($fullURL, 'demo-' . $i);
        //         if ($contains === true) {
        //             $data = config('custom.' . 'demo-' . $i);
        //         }
        //     }
        // } else {
        //     $data = config('custom.custom');
        // }

        // default data array
        $DefaultData = [
            'mainLayoutType' => 'vertical',
            'theme' => 'light',
            'sidebarCollapsed' => false,
            'navbarColor' => '',
            'horizontalMenuType' => 'floating',
            'verticalMenuNavbarType' => 'floating',
            'footerType' => 'static', //footer
            'bodyClass' => '',
            'pageHeader' => true,
            'contentLayout' => 'default',
            'blankPage' => false,
            'defaultLanguage' => 'en',
            'direction' => env('MIX_CONTENT_DIRECTION', 'ltr'),
        ];

        // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
        $data = array_merge($DefaultData, config('custom.custom'));

        // All options available in the template
        $allOptions = [
            'mainLayoutType' => array('vertical', 'horizontal'),
            'theme' => array('light' => 'light', 'dark' => 'dark-layout', 'semi-dark' => 'semi-dark-layout'),
            'sidebarCollapsed' => array(true, false),
            'navbarColor' => array('bg-primary', 'bg-info', 'bg-warning', 'bg-success', 'bg-danger', 'bg-dark'),
            'horizontalMenuType' => array('floating' => 'navbar-floating', 'static' => 'navbar-static', 'sticky' => 'navbar-sticky'),
            'horizontalMenuClass' => array('static' => 'menu-static', 'sticky' => 'fixed-top', 'floating' => 'floating-nav'),
            'verticalMenuNavbarType' => array('floating' => 'navbar-floating', 'static' => 'navbar-static', 'sticky' => 'navbar-sticky', 'hidden' => 'navbar-hidden'),
            'navbarClass' => array('floating' => 'floating-nav', 'static' => 'static-top', 'sticky' => 'fixed-top', 'hidden' => 'd-none'),
            'footerType' => array('static' => 'footer-static', 'sticky' => 'fixed-footer', 'hidden' => 'footer-hidden'),
            'pageHeader' => array(true, false),
            'contentLayout' => array('default', 'content-left-sidebar', 'content-right-sidebar', 'content-detached-left-sidebar', 'content-detached-right-sidebar'),
            'blankPage' => array(false, true),
            'sidebarPositionClass' => array('content-left-sidebar' => 'sidebar-left', 'content-right-sidebar' => 'sidebar-right', 'content-detached-left-sidebar' => 'sidebar-detached sidebar-left', 'content-detached-right-sidebar' => 'sidebar-detached sidebar-right', 'default' => 'default-sidebar-position'),
            'contentsidebarClass' => array('content-left-sidebar' => 'content-right', 'content-right-sidebar' => 'content-left', 'content-detached-left-sidebar' => 'content-detached content-right', 'content-detached-right-sidebar' => 'content-detached content-left', 'default' => 'default-sidebar'),
            'defaultLanguage' => array('en' => 'en', 'fr' => 'fr', 'de' => 'de', 'pt' => 'pt'),
            'direction' => array('ltr', 'rtl'),
        ];

        //if mainLayoutType value empty or not match with default options in custom.php config file then set a default value
        foreach ($allOptions as $key => $value) {
            if (array_key_exists($key, $DefaultData)) {
                if (gettype($DefaultData[$key]) === gettype($data[$key])) {
                    // data key should be string
                    if (is_string($data[$key])) {
                        // data key should not be empty
                        if (isset($data[$key]) && $data[$key] !== null) {
                            // data key should not be exist inside allOptions array's sub array
                            if (!array_key_exists($data[$key], $value)) {
                                // ensure that passed value should be match with any of allOptions array value
                                $result = array_search($data[$key], $value, 'strict');
                                if (empty($result) && $result !== 0) {
                                    $data[$key] = $DefaultData[$key];
                                }
                            }
                        } else {
                            // if data key not set or
                            $data[$key] = $DefaultData[$key];
                        }
                    }
                } else {
                    $data[$key] = $DefaultData[$key];
                }
            }
        }

        //layout classes
        $layoutClasses = [
            'theme' => $data['theme'],
            'layoutTheme' => $allOptions['theme'][$data['theme']],
            'sidebarCollapsed' => $data['sidebarCollapsed'],
            'verticalMenuNavbarType' => $allOptions['verticalMenuNavbarType'][$data['verticalMenuNavbarType']],
            'navbarClass' => $allOptions['navbarClass'][$data['verticalMenuNavbarType']],
            'navbarColor' => $data['navbarColor'],
            'horizontalMenuType' => $allOptions['horizontalMenuType'][$data['horizontalMenuType']],
            'horizontalMenuClass' => $allOptions['horizontalMenuClass'][$data['horizontalMenuType']],
            'footerType' => $allOptions['footerType'][$data['footerType']],
            'sidebarClass' => 'menu-expanded',
            'bodyClass' => $data['bodyClass'],
            'pageHeader' => $data['pageHeader'],
            'blankPage' => $data['blankPage'],
            'blankPageClass' => '',
            'contentLayout' => $data['contentLayout'],
            'sidebarPositionClass' => $allOptions['sidebarPositionClass'][$data['contentLayout']],
            'contentsidebarClass' => $allOptions['contentsidebarClass'][$data['contentLayout']],
            'mainLayoutType' => $data['mainLayoutType'],
            'defaultLanguage' => $allOptions['defaultLanguage'][$data['defaultLanguage']],
            'direction' => $data['direction'],
        ];
        // set default language if session hasn't locale value the set default language
        if (!session()->has('locale')) {
            app()->setLocale($layoutClasses['defaultLanguage']);
        }

        // sidebar Collapsed
        if ($layoutClasses['sidebarCollapsed'] == 'true') {
            $layoutClasses['sidebarClass'] = "menu-collapsed";
        }

        // blank page class
        if ($layoutClasses['blankPage'] == 'true') {
            $layoutClasses['blankPageClass'] = "blank-page";
        }

        return $layoutClasses;
    }

    /**
     * @param $pageConfigs
     */
    public static function updatePageConfig($pageConfigs)
    {
        $demo = 'custom';
        // $fullURL = request()->fullurl();
        // if (App()->environment() === 'production') {
        //     for ($i = 1; $i < 7; $i++) {
        //         $contains = Str::contains($fullURL, 'demo-' . $i);
        //         if ($contains === true) {
        //             $demo = 'demo-' . $i;
        //         }
        //     }
        // }
        if (isset($pageConfigs)) {
            if (count($pageConfigs) > 0) {
                foreach ($pageConfigs as $config => $val) {
                    Config::set('custom.' . $demo . '.' . $config, $val);
                }
            }
        }
    }


    public static function setHoursDate($date, $hour)
    {
        $date->setTimeFromTimeString($hour);
        return $date;
    }
}
