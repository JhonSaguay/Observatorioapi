import requests
import psycopg2
import json
import time
def savedatabase(conexion,my_dict):
    cur = conexion.cursor()
    for dato in my_dict:
        json_string=(json.dumps(dato))
        sql1="insert into apidata(datosjson) values ('"+json_string+"')"
        cur.execute(sql1)
    # conexion.commit()
def consultarapicompras(apiurl,conexion):
    my_dict={'data':['prueba']}
    cont=1
    while len(my_dict['data'])>0:
        try:
            r = requests.get(apiurl+str(cont))
            my_dict = r.json()
            if len(my_dict['data'])==0:
                continue
            savedatabase(conexion,my_dict['data'])
            conexion.commit()
            print('entro: '+str(cont))
            cont+=1
        except:
            print("Ha ocurrido un error")
            time.sleep(5)
        


apiurl = "https://datosabiertos.compraspublicas.gob.ec/PLATAFORMA/api/search_ocds?year=2021&search=&page="
conexion = psycopg2.connect(host="localhost", database="PuebasApi", user="postgres", password="1998414")
consultarapicompras(apiurl,conexion)
conexion.close()
