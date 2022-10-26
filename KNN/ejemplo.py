#!/usr/bin/env python
from base64 import encode
from cmath import acos
import sys
import numpy as np
import psycopg2                                    
from sklearn import preprocessing
from sqlalchemy import create_engine   
import pandas as pd 
import math


###conexion con la base de datos###
#creamos conexion con los datos especificados
engine = create_engine('postgresql+psycopg2://postgres:root@localhost/reporthing')
#Seleccionamos los datos de la bd
sql = "SELECT tipo, hora, zona FROM reportes WHERE estatus = 1 AND fecha > CURRENT_DATE - INTERVAL '1' MONTH"
#creamos un dataframe con la consulta
datos = pd.read_sql_query(sql, engine)
###Recojemos los datos enviados desde php###
#zona  = sys.argv[1]
#hora  = sys.argv[2]

#datos de ejemplo
zona = "guadalajara"
hora = "13"

###tratamiento y normalización de los datos###
#separamos el dataframe por columnas
z = np.ravel(datos[['zona']])
h = np.ravel(datos[['hora']])
t = np.ravel(datos[['tipo']])

#Cambia los datos categoricos a numericos
label1 = preprocessing.LabelEncoder()
zl = label1.fit_transform(z)
zona_l = label1.transform([zona])
#Combina los datos
x = list(zip(zl,h))
x = np.array(x)
newdata = list(zip(zona_l,hora))
newdata = np.array(newdata)
#normaliza los datos utilizando Escalado 
minmax = preprocessing.MinMaxScaler()
x = minmax.fit_transform(x.astype(float))
newdata = minmax.transform(newdata.astype(float))
#Genera lista con los datos normalizados para poder trabajarlos comodamente
zone = np.empty(len(x))
hour = np.empty(len(x))
distancia = np.empty(len(x))
for i in range(0,len(x)):
     zone[i] = x[i][0]
     hour[i] = x[i][1]
#calculo de distancia euclideana
for i in range(0,len(x)):
    sum = ((newdata[0][0] - zone[i])**2 + (newdata[0][1] - hour[i])**2)
    sum = math.sqrt(sum)
    distancia[i] = sum
#Ordenamiento y selección de los k vecinos más cercanos
datatrained = list(zip(t,distancia))
datatrained = sorted(datatrained, key=lambda x: x[1])
k = 7
nearest = np.empty(k)
for i in range(0,k):
    nearest[i] = datatrained[i][0] 
#definir clase
asalto = 0
accidente = 0
acoso = 0
precaucion = 0
otro = 0
#conteo clases target
for i in range(0,k):
    if nearest[i] == 1:
        asalto = asalto + 1
    elif nearest[i] == 2:
        accidente = accidente + 1
    elif nearest[i] == 3:
        acoso = acoso + 1
    elif nearest[i] == 4:
        precaucion = precaucion + 1
    elif nearest[i] == 5:
        otro = otro + 1
#eleccion de clase con mas ocurrencias
if asalto > accidente and asalto > acoso and asalto > precaucion and asalto > otro:
    print(1)
elif accidente > asalto  and accidente > acoso and accidente > precaucion and accidente > otro:
    print(2)
elif acoso > asalto  and acoso > accidente and acoso > precaucion and acoso > otro:
    print(3)
elif precaucion > asalto  and precaucion > acoso and precaucion > accidente and precaucion > otro:
    print(4)
elif otro > asalto  and otro > acoso and otro > precaucion and otro > accidente:
    print(5)