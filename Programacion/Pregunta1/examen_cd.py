##Para poder trabajar con bases de datos
import sqlite3 as lite
import sys

##Me conecto a una base de datos llamada cds
conexion = lite.connect("cds.db")
##Establezco un cursor para saber en que punto de la base de datos trabajare
cursor = conexion.cursor()


def listaCD():
    #Menu inicial
    print("Escoge tu opcion")
    print("1.-Introduce nuevo cd")
    print("2.-Listar cd")
    print("3.-Actualizar cd")
    print("4.-Borrar cd")
    opcion = input()
    if opcion == "1":
        ##Introducir datos para nuevo cd
        print("Introduce los datos del nuevo registro:")
        TituloCD = input("Titulo del cd: ")
        Artista = input("Artista: ")
        AnioLanzamiento = input("Ani de lanzamiento: ")
        Genero = input("Genero Musical: ")
        cursor.execute("INSERT INTO cd VALUES (NULL, ?, ?, ?, ?)", (TituloCD, Artista, AnioLanzamiento, Genero))
        ##Guardar el registro
        conexion.commit()
        print("Registro insertado con éxito.")
        print("\n")
    if opcion == "2":
        ##Mostrar todos los cd
        cursor.execute("SELECT * FROM cd")
        datos = cursor.fetchall()
        print("ID | Titulo CD".ljust(25) + "| Artista".ljust(25) + "| Anio de Lanzamiento".ljust(25) + "| Genero Musical".ljust(25))
        print("-" * 100)
        for registro in datos:
            print(str(registro[0]).ljust(3) + "| " + registro[1].ljust(25) + "| " + registro[2].ljust(25) + "| " + str(registro[3]).ljust(25) + "| " + registro[4].ljust(25))
        print("\n")
    if opcion == "3":
        ##Actualizar datos de cd
        print("Introduce el nombre del CD que quieres actualizar:")
        nombre_buscado = input()
        cursor.execute("SELECT * FROM cd WHERE TituloCD=?", (nombre_buscado,))
        registro = cursor.fetchone()
        ##Mensaje por si error
        if registro is None:
            print("No se ha encontrado el registro.")
        else:
            ##Secuencia por si hay acierto
            print(f"Registro encontrado: ID: {registro[0]} | TituloCD: {registro[1]} | Artista: {registro[2]} | AnioLanzamiento: {registro[3]} | Genero: {registro[4]}")
            print("Introduce los nuevos datos:")
            nuevo_TituloCD = input("Nuevo nombre: ")
            nuevo_Artista = input("Nuevo artista: ")
            nuevo_AnioLanzamiento = input("Nuevo año de lanzamiento: ")
            nuevo_Genero = input("Nuevo género musical: ")
            cursor.execute("UPDATE cd SET TituloCD=?, Artista=?, AnioLanzamiento=?, Genero=? WHERE Identificador=?", (nuevo_TituloCD, nuevo_Artista, nuevo_AnioLanzamiento, nuevo_Genero, registro[0]))
            ##Guardar el registro
            conexion.commit()
            print("Registro actualizado con éxito.")
            print("\n")
    if opcion == "4":
        print("Introduce el ID del registro que quieres borrar:")
        id_borrar = input()
        cursor.execute("SELECT * FROM cd WHERE Identificador = ?", (id_borrar,))
        registro = cursor.fetchone()
        ##Mensaje por si error
        if registro is None:
            print("No se ha encontrado el registro.")
        else:
            ##Secuencia por si hay acierto
            print("Registro encontrado: ID: {registro[0]} | TituloCD: {registro[1]} | Artista: {registro[2]} | AnioLanzamiento: {registro[3]} | Genero: {registro[4]}")
            confirmar = input("¿Estás seguro de que quieres borrar este registro? (s/n)")
            if confirmar == "s":
                cursor.execute("DELETE FROM cd WHERE Identificador = ?", (id_borrar,))
                conexion.commit()
                print("Registro borrado con éxito.")
            else:
                print("Operación cancelada.")
            print("\n")
      
        ##bucle
    listaCD()
listaCD()
