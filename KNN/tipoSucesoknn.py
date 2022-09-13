#!/usr/bin/env python
import pandas as pd                                 #pip install pandas
import seaborn as sns                               #pip install seaborn
import sys
import numpy as np
import mysql.connector                              #pip install mysql-connector-python
from sklearn.neighbors import KNeighborsClassifier  #pip install sklearn
from sklearn import preprocessing
from sqlalchemy import create_engine                #pip install sqlalchemy

###conexion con la base de datos###
#definimos parametros de la bd
usuario = 'root'
contrasena = 'root'
url_servidor = 'localhost'
puerto = '3306'
esquema = 'reporthing'
plugin_autenticacion = 'mysql_native_password'

#creamos conexion con los datos especificados
conn = 'mysql+mysqlconnector://{0}:{1}@{2}:{3}/{4}?auth_plugin={5}'
conn = conn.format(usuario, contrasena, url_servidor, puerto, esquema, plugin_autenticacion)
engine = create_engine(conn)

#Seleccionamos los datos de la bd
sql = "SELECT tipo, fecha, hora, zona FROM reportes WHERE estatus = 1 AND fecha IS NOT NULL AND hora IS NOT NULL AND zona IS NOT NULL"
#creamos un dataframe con la consulta
datos = pd.read_sql_query(sql, engine)
#creamos un nuevo registro con los datos recogidos del usuario desde php
#zona  = sys.argv[1]
#fecha = sys.argv[2]
#hora  = sys.argv[3]
#datos de ejemplo
zona = "zapopan"
fecha = "2022-09-11"
hora = "18:10:02"
nuevo = {fecha,hora,zona}
#normaliza los datos
encoder = preprocessing.LabelEncoder()
zona_norm = encoder.fit_transform(np.ravel(datos[['zona']]))
fecha_norm = encoder.fit_transform(np.ravel(datos[['fecha']]))
hora_norm = encoder.fit_transform(np.ravel(datos[['hora']]))
tipo_norm = encoder.fit_transform(np.ravel(datos[['tipo']]))
#print(fecha_norm)
datos_norm = list(zip(zona_norm,fecha_norm,hora_norm))
knn = KNeighborsClassifier(n_neighbors=3)
#entrena el modelo con los datos normalizados
knn.fit(datos_norm,tipo_norm)
#realiza la predicción en base a lo entrenado
predict = knn.predict(nuevo)

print(predict)