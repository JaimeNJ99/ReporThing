#!/usr/bin/env python
from base64 import encode
import sys
import numpy as np
import psycopg2                                    
from sklearn import preprocessing
from sqlalchemy import create_engine   
import pandas as pd 
import math
from collections import Counter

###conexion con la base de datos###
#creamos conexion con los datos especificados
engine = create_engine('postgresql+psycopg2://postgres:root@localhost/reporthing')
#Seleccionamos los datos de la bd
sql = "SELECT tipo, latitud, longitud, hora, zona  FROM reportes WHERE estatus = 1 AND fecha >= CURRENT_DATE - 14"
#creamos un dataframe con la consulta
datos = pd.read_sql_query(sql, engine)
###Recojemos los datos enviados desde php###
zona  = sys.argv[1]
hora  = sys.argv[2]
latitud = sys.argv[3]
longitud = sys.argv[4]

#datos de ejemplo
#zona = "zapopan"
#hora = "13"
#latitud = "20.7416236"
#longitud = "-103.3843281"

###tratamiento y normalización de los datos###
#separamos el dataframe por columnas
z = np.ravel(datos[['zona']])
h = np.ravel(datos[['hora']])
lat = np.ravel(datos[['latitud']])
lon = np.ravel(datos[['longitud']])
t = np.ravel(datos[['tipo']])

#Cambia los datos zona a numericos
label1 = preprocessing.LabelEncoder()
zl = label1.fit_transform(z)
zona_l = label1.transform([zona])
#Combina los datos
zh = list(zip(zl,h))
zh = np.array(zh)
newzh = list(zip(zona_l,hora))
newzh = np.array(newzh)
#normaliza los datos utilizando Escalado 
minmax = preprocessing.MinMaxScaler()
zh = minmax.fit_transform(zh.astype(float))
newzh = minmax.transform(newzh.astype(float))

#Genera lista con los datos normalizados para poder trabajarlos comodamente
zone = np.empty(len(zh))
hour = np.empty(len(zh))
distancia = np.empty(len(zh))
for i in range(0,len(zh)):
     zone[i] = zh[i][0]
     hour[i] = zh[i][1]
#calculo de distancias 
dist_e = 0
dist_h = 0
sum = 0
for i in range(0,len(zh)):
    #Distancia euclideana variables numericas
    dist_e = ((float(latitud) - float(lat[i]))**2 + 
              (float(longitud) - float(lon[i]))**2 + 
              (float(newzh[0][0]) - float(zone[i]))**2 + 
              (float(newzh[0][1]) - float(hour[i]))**2)
    dist_e = math.sqrt(dist_e)
    #suma de distancias
    sum = dist_e 
    #distancia final
    distancia[i] = sum
#Ordenamiento y selección de los k vecinos más cercanos
datatrained = list(zip(t,distancia))
datatrained = sorted(datatrained, key=lambda x: x[1])

k = 8
nearest = np.empty(k)
for i in range(0,k):
    nearest[i] = int(datatrained[i][0])
#definir clase
asalto = 0
accidente = 0
acoso = 0
precaucion = 0
otro = 0
#conteo clases target
res = Counter(nearest)
#Elección de clase con más ocurrencias
print(int(res.most_common()[0][0])) 
