INSERT INTO Questions (question_type, question_text)
VALUES ('one_choice', '¿Qué significa PHP?'),
       ('one_choice', '¿Cuál de los siguientes NO es un tipo de dato de PHP?'),
       ('one_choice', '¿Cuál es el resultado de `echo "Hola" . " " . "Mundo";`?'),
       ('one_choice', 'En PHP, ¿qué bucle se utiliza para ejecutar un bloque de código un número especificado de veces?'),
       ('one_choice', '¿Qué función de PHP se utiliza para abrir un archivo para escritura?');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (false, 'one_choice', 'a', 1, 'Página de inicio personal'),
       (true, 'one_choice', 'b', 1, 'PHP: Procesador de hipertexto (Respuesta correcta)'),
       (false, 'one_choice', 'c', 1, 'Procesador de hipervínculos privados'),
       (false, 'one_choice', 'd', 1, 'Página de enlace PHP');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (false, 'one_choice', 'a', 2, 'Entero'),
       (false, 'one_choice', 'b', 2, 'Booleano'),
       (true, 'one_choice', 'c', 2, 'Caracter'),
       (false, 'one_choice', 'd', 2, 'Flotante');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (false, 'one_choice', 'a', 3, 'HelloWorld'),
       (true, 'one_choice', 'b', 3, 'Hola Mundo'),
       (false, 'one_choice', 'c', 3, 'HelloWorld'),
       (false, 'one_choice', 'd', 3, '"Hola Mundo"');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (true, 'one_choice', 'a', 4, 'Bucle for'),
       (false, 'one_choice', 'b', 4, 'Bucle while'),
       (false, 'one_choice', 'c', 4, 'Bucle do...while'),
       (false, 'one_choice', 'd', 4, 'Bucle foreach');

INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
VALUES (false, 'one_choice', 'a', 5, 'fopen'),
       (false, 'one_choice', 'b', 5, 'file_open'),
       (false, 'one_choice', 'c', 5, 'open_file'),
       (true, 'one_choice', 'd', 5, 'Ninguna de las anteriores');

