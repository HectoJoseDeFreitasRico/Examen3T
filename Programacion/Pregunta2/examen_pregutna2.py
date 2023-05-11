##Importamos librerias
from PIL import Image
import math
##Elegimos y cargamos imagen
imagen = Image.open("examen.jpg")
pixeles = imagen.load()
print(imagen.size)

print(pixeles[0,0])
##Definimos variables de tamaño
altura = imagen.size[1]
anchura = imagen.size[0]
##Definimos colores
for x in range(0,anchura):
    for y in range(0,altura):
        rojo = pixeles[x,y][0]
        verde = pixeles[x,y][1]
        azul = pixeles[x,y][2]
        color = math.floor((rojo+verde+azul)/3)
##Si un color tiene mas de 127 sera negro y si no sera blanco
        if color > 127:
            rojo = 255
            verde = 255
            azul = 255
        else:
            rojo = 0
            verde = 0
            azul = 0

        pixeles[x,y] = (rojo,verde,azul)
##Guardamos imagen
imagen.save("examen2.jpg")
