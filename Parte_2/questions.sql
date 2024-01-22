INSERT INTO Questions (question_type, question_text)
VALUES ('one_choice', '¿Qué significa PHP?'),
       ('one_choice', '¿Cuál de los siguientes NO es un tipo de dato de PHP?'),
       ('one_choice', '¿Cuál es el resultado de `echo "Hola" . " " . "Mundo";`?'),
       ('one_choice', 'En PHP, ¿qué bucle se utiliza para ejecutar un bloque de código un número especificado de veces?'),
       ('one_choice', '¿Qué función de PHP se utiliza para abrir un archivo para escritura?');


INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (false, 'one_choice', 'a', 6, 'Página de inicio personal'),
       (true, 'one_choice', 'b', 6, 'PHP: Procesador de hipertexto (Respuesta correcta)'),
       (false, 'one_choice', 'c', 6, 'Procesador de hipervínculos privados'),
       (false, 'one_choice', 'd', 6, 'Página de enlace PHP');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (false, 'one_choice', 'a', 7, 'Entero'),
       (false, 'one_choice', 'b', 7, 'Booleano'),
       (true, 'one_choice', 'c', 7, 'Caracter'),
       (false, 'one_choice', 'd', 7, 'Flotante');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (false, 'one_choice', 'a', 8, 'HelloWorld'),
       (true, 'one_choice', 'b', 8, 'Hola Mundo'),
       (false, 'one_choice', 'c', 8, 'HelloWorld'),
       (false, 'one_choice', 'd', 8, '"Hola Mundo"');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (true, 'one_choice', 'a', 9, 'Bucle for'),
       (false, 'one_choice', 'b', 9, 'Bucle while'),
       (false, 'one_choice', 'c', 9, 'Bucle do...while'),
       (false, 'one_choice', 'd', 9, 'Bucle foreach');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (false, 'one_choice', 'a', 10, 'fopen'),
       (false, 'one_choice', 'b', 10, 'file_open'),
       (false, 'one_choice', 'c', 10, 'open_file'),
       (true, 'one_choice', 'd', 10, 'Ninguna de las anteriores');

