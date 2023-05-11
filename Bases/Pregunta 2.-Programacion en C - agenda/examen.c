/*

Programa coleccion de cd's 
V1
Por Hector

*/

#include <stdio.h>
//Para definir un elemento que no va a cambiar
#include <string.h>
#define PI 3.1416
//Nombre de constantes en mayus y variables en minus
#define NOMBREPROGRAMA "Programa CD's"
#define VERSION "1.0"
#define AUTOR "Hector"

int main(int argc, char *argv[]){ 
    
    //Creo una estructura
    struct ColeccionCD{
        char titulo[50];
        char artista[50];
        char anolanzamiento[50];
        char genero[50];
    };
    
    struct ColeccionCD coleccion[100];
    strcpy(coleccion[0].titulo,"What a Wonderful World");
    strcpy(coleccion[0].artista,"Louis Amstrong");
    strcpy(coleccion[0].anolanzamiento,"1967");
    strcpy(coleccion[0].genero,"Jazz");
    
    strcpy(coleccion[1].titulo,"Thriller");
    strcpy(coleccion[1].artista,"Michael Jackson");
    strcpy(coleccion[1].anolanzamiento,"1982");
    strcpy(coleccion[1].genero,"Pop");
    
    strcpy(coleccion[2].titulo,"Rap God");
    strcpy(coleccion[2].artista,"Eminem");
    strcpy(coleccion[2].anolanzamiento,"2013");
    strcpy(coleccion[2].genero,"Rap");
    //Mensaje de bienvenida
    printf("%s v%s \n",NOMBREPROGRAMA,VERSION);
    printf("por %s \n",AUTOR);
    printf("Selecciona una opcion\n");
    printf("\t 1 - Listado de coleccion de CD's \n");
    printf("\t 2 - Indtroducir un cd \n"); 
    printf("\t 3 - Eliminar un cd \n");
    printf("\t 4 - Buscar un cd \n");
    printf("\t 5 - Actualizar un cd \n");
    printf("Tu opcion: \n");
    char opcion = getchar();
    printf("La opcion que has seleccionado es: %c \n",opcion);
    //Vamos a decidir que hacemos en cada parte del programa
    switch(opcion){
        case '1':
            printf("A continuacion te ofreszco un listado de coleccion de CD's \n");
            printf("\n");
            for(int i = 0;i<10;i = i + 1){
                if(strcmp(coleccion[i].titulo,"")){ 
                    printf("El titulo es: %s \n",coleccion[i].titulo);
                    printf("El artista es: %s \n",coleccion[i].artista);
                    printf("El anio de lanzamiento es: %s \n",coleccion[i].anolanzamiento);
                    printf("El genero es: %s \n",coleccion[i].genero);
                    printf("\n");
                }
            }    
            break;
        case '2':
            printf("Vamos a introducir un CD \n");
            break;
        case '3':
            printf("Vamos a borrar un CD \n");
            break;
        case '4':
            printf("Vamos a buscar un CD \n");
            break;
        case '5':
            printf("Vamos a actualizar un CD \n");
            break;
        default:
            printf("Eso no es una opcion");
    }
    printf("Finalizando la ejecucion del programa...");
    printf("\n");
    return 0;
}