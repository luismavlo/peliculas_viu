# APLICACIÓN DE SERIES VIU

## Requesitos para ejecutar el proyecto

1. tener instalado xamp, wamp, mamp o algun servidor apache para ejecutar la aplicación
2. tener instalado docker

##  Pasos para iniciar la aplicación

1. Clonar el repositorio y configurarlo en tu servidor apache:
    ```bash
    https://github.com/luismavlo/peliculas_viu.git

2. Ejecutar el comando en la raiz del proyecto 
    ```bash
   docker-compose up -d
   
3. Entrar al navegador por la ruta ```/Home/load_database``` para cargar la base de datos, a continuación veras un ejemplo desde xamp
   ```bash
   http://localhost/actividad1-viu/Home/load_database
   
4. Entar a la ruta raiz ```/``` para probar la aplicación
   ```bash
   http://localhost/actividad1-viu/