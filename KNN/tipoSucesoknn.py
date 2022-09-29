#!/usr/bin/env python
from base64 import encode
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
sql = "SELECT tipo, hora, zona FROM reportes WHERE estatus = 1 AND fecha IS NOT NULL AND hora IS NOT NULL AND zona IS NOT NULL"
#creamos un dataframe con la consulta
datos = pd.read_sql_query(sql, engine)

#####creamos un nuevo registro con los datos recogidos del usuario desde php
#zona  = sys.argv[1]
#hora  = sys.argv[2]

#datos de ejemplo
zona = "zapopan"
fecha = "2022-09-11"
hora = "16"

#####normaliza los datos
#normaliza zona
encoder = preprocessing.LabelEncoder()
zona_norm = encoder.fit_transform(np.ravel(datos[['zona']]))
zona_e = encoder.transform([zona])

#normaliza hora
hora_norm = encoder.fit_transform(np.ravel(datos[['hora']]))
hora_e = encoder.transform([hora])

#normaliza tipo suceso
c = encoder.fit_transform(np.ravel(datos[['tipo']]))
#generamos una lista con los datos normalizados
d = list(zip(zona_norm,hora_norm))

#Creación de objeto clasificador y asignación del valor de k
knn = KNeighborsClassifier(n_neighbors=3)
###entrena el modelo con los datos normalizados
knn.fit(d,c)

###realiza la predicción en base a lo entrenado
#Creación de lista con los datos de entrada
entrada = list(zip(zona_e,hora_e))
#prediccion en base a los datos de entrada y el modelo entrenado
predict = knn.predict(entrada)

#Transformación de la predicción al tipo de suceso
if predict == 0:
    predicted = "Asalto"
elif predict == 1:
    predicted = "Accidente"
elif predict == 2:
    predicted = "Acoso"
elif predict == 3:
    predicted = "Precaución"
elif predict == 4:
    predicted = "Otro"
else:
    predicted = "Ha ocurrido un error inesperado"
#retorno de datos a la web
print(predicted)