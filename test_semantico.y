%{
#include <stdio.h>
#include <string.h>
int yylex();
int yyerror(char *s);
%}
%token STRING NUM OTHER SEMICOLON EQUAL
%type <name> STRING
%type <number> NUM
%union {
    char name[20];
    int number;
}
%% 
prog:
    stmts
;
stmts:
    | stmt SEMICOLON stmts
;
stmt:
    STRING EQUAL STRING {  
        printf("Asignación válida: %s = %s\n", $1, $3);
    }
    | STRING EQUAL NUM {  
        printf("Asignación válida: %s = %d\n", $1, $3);
    }
    | NUM EQUAL STRING {  
        printf("Error: no se puede asignar un string a un número.\n");
    }
    | NUM EQUAL NUM {  
        printf("Asignación válida de números: %d = %d\n", $1, $3);
    }
    | OTHER {
        printf("Error: entrada no válida\n");
    }
;
%%
int yyerror(char *s) {
    printf("Error de sintaxis: %s\n", s);
    return 0;
}
int main() {
    yyparse();
    return 0;
}