INSERT INTO Questions (question_type, question_text)
VALUES ('one_choice', '¿Qué significa PHP?'),
       ('one_choice', '¿Cuál de los siguientes NO es un tipo de dato de PHP?'),
       ('one_choice', '¿Cuál es el resultado de `echo "Hola" . " " . "Mundo";`?'),
       ('one_choice', 'En PHP, ¿qué bucle se utiliza para ejecutar un bloque de código un número especificado de veces?'),
       ('one_choice', '¿Qué función de PHP se utiliza para abrir un archivo para escritura?');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (false, 'one_choice', 'a', 7, 'Página de inicio personal'),
       (true, 'one_choice', 'b', 7, 'PHP: Procesador de hipertexto'),
       (false, 'one_choice', 'c', 7, 'Procesador de hipervínculos privados'),
       (false, 'one_choice', 'd', 7, 'Página de enlace PHP');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (false, 'one_choice', 'a', 8, 'Entero'),
       (false, 'one_choice', 'b', 8, 'Booleano'),
       (true, 'one_choice', 'c', 8, 'Caracter'),
       (false, 'one_choice', 'd', 8, 'Flotante');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (false, 'one_choice', 'a', 9, 'HelloWorld'),
       (true, 'one_choice', 'b', 9, 'Hola Mundo'),
       (false, 'one_choice', 'c', 9, 'HelloWorld'),
       (false, 'one_choice', 'd', 9, '"Hola Mundo"');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (true, 'one_choice', 'a', 10, 'Bucle for'),
       (false, 'one_choice', 'b', 10, 'Bucle while'),
       (false, 'one_choice', 'c', 10, 'Bucle do...while'),
       (false, 'one_choice', 'd', 10, 'Bucle foreach');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (false, 'one_choice', 'a', 11, 'fopen'),
       (false, 'one_choice', 'b', 11, 'file_open'),
       (false, 'one_choice', 'c', 11, 'open_file'),
       (true, 'one_choice', 'd', 11, 'Ninguna de las anteriores');

