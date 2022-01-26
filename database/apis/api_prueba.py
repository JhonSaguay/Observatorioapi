import requests
import json
import time
import mysql.connector
from mysql.connector import Error

def saveindicador(conexion):
    cur=conexion.cursor()
    sqlconsulta="SELECT JSON_EXTRACT(datosjson,'$.internal_type') as internal_type,sum(JSON_EXTRACT(datosjson,'$.amount')) as total_amount FROM apidata group by JSON_EXTRACT(datosjson,'$.internal_type');"
    cur.execute(sqlconsulta)
    data = cur.fetchall()
    print(data)

def savedatabasemsql(conexion,my_dict):
    cur = conexion.cursor()
    for dato in my_dict:
        json_string=(json.dumps(dato))
        json_string2=json.loads(json_string)
        json_final=json.dumps(json_string2,ensure_ascii=False)
        # print(json_final)
        sql1="insert into apidata(datosjson) values ('"+json_final+"')"
        try:
            cur.execute(sql1)
        except:
            print('entro')
            print(sql1)
            print(dato['description'])
        
def consultarapicomprasmsql(apiurl,conexion):
    my_dict={'data':['prueba']}
    cont=1
    while len(my_dict['data'])>0:
        entry_url=apiurl+str(cont)
        try:
            
            r = requests.get(entry_url)
            my_dict = r.json()
            if len(my_dict['data'])==0:
                continue
            savedatabasemsql(conexion,my_dict['data'])
            conexion.commit()
            print('entro: '+str(cont))
            cont+=1
        except:
            print("Ha ocurrido un error")
            time.sleep(5)
        

apiurl = "https://datosabiertos.compraspublicas.gob.ec/PLATAFORMA/api/search_ocds?year=2021&search=&page="
try:
    connection = mysql.connector.connect(host='localhost',
                                         database='observatorio_f',
                                         user='root',
                                         password='1998414')
    if connection.is_connected():
        consultarapicomprasmsql(apiurl,connection)
        db_Info = connection.get_server_info()
        print("Connected to MySQL Server version ", db_Info)
except Error as e:
    print("Error while connecting to MySQL", e)
finally:
    if connection.is_connected():
        connection.close()
        print("MySQL connection is closed")

