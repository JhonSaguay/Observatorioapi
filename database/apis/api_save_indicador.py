import requests
import json
import time
import mysql.connector
from mysql.connector import Error

def saveindicador(conexion,apiurl):
    print('entro')
    cur=conexion.cursor()
    sqlconsulta="SELECT JSON_EXTRACT(datosjson,'$.internal_type') as internal_type,sum(JSON_EXTRACT(datosjson,'$.amount')) as total_amount FROM apidata group by JSON_EXTRACT(datosjson,'$.internal_type');"
    # sqlconsulta='''SELECT CONCAT('[', better_result, ']') AS best_result FROM( 
    #             SELECT GROUP_CONCAT('{', my_json, '}' SEPARATOR ',') AS better_result FROM(
    #             SELECT CONCAT( 
    #                 '"internal_type":','"',JSON_UNQUOTE(JSON_EXTRACT(datosjson,'$.internal_type')) , '"',','
    #                 '"total_amount":',  sum(JSON_EXTRACT(datosjson,'$.amount')) or 0
    #                 ) AS my_json 
    #             FROM observatorio_f.apidata group by JSON_EXTRACT(datosjson,'$.internal_type')
    #             ) AS more_json
    #             ) AS yet_more_json;'''
    cur.execute(sqlconsulta)
    data = cur.fetchall()
    #convertir lista en json
    cabeceras=('internal_type','total_amount')
    lista_datos=[]
    valores=[]
    for element in data:
        valores=[element[0].replace('"',''),element[1]]
        dict_from_list = dict(zip(cabeceras, valores))
        lista_datos.append(dict_from_list)
    ##update indicadores
    sqlupdate="update indicadores set active=0 where categoria='funcion_publica_presupuesto_1'"
    cur=conexion.cursor()
    cur.execute(sqlupdate)
    cur.close
    #guardar data
    datos={"en":lista_datos}
    json_datos=json.dumps(datos)
    sql1="insert into indicadores(nombre,categoria,descripcion,temporalidad,proveedor_dato,direccion_api,tipo,active,datos_indicador) values (%s,%s,%s,%s,%s,%s,%s,%s,%s);"
    # json_string='"'+ json_string +'"'
    val=('Prueba indicador','funcion_publica_presupuesto_1','descripcion',
    'temporalidad','proveedor_dato',apiurl,0,1,json_datos)
    cur=conexion.cursor()
    cur.execute(sql1,val)
    conexion.commit()
    cur.close()

def savedatabasemsql(conexion,my_dict):
    cur = conexion.cursor()
    for dato in my_dict:
        json_string=(json.dumps(dato))
        sql1="insert into apidata(datosjson) values ('"+json_string+"')"
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
        print(entry_url)
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
        saveindicador(connection,apiurl)
        # consultarapicomprasmsql(apiurl,connection)
        db_Info = connection.get_server_info()
        print("Connected to MySQL Server version ", db_Info)
except Error as e:
    print("Error while connecting to MySQL", e)
finally:
    if connection.is_connected():
        connection.close()
        print("MySQL connection is closed")

