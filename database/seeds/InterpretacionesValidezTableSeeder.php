<?php

use Illuminate\Database\Seeder;

use App\InterValidez;

class InterpretacionesValidezTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,'Muy Alto',80,'80 o más','Probablemente inválido','El sujeto aparenta estar bien adaptado','Resistencia a la prueba o ingenuidad'],
            [1,'Alto',70,'70 a 79','Validez cuestionable','Se responde al azar-Se niegan los defectos','Estado de confusión-Represión--Falta de insight'],
            [1,'Moderado',60,'60 a 69','Probablemente válido','Defensividad marcada','Persona muy convencional y conformista-El sujeto puede ser moralista o rígido'],
            [1,'Medio',50,'50 a 59','Válido','Actitud adecuada ante la prueba','Conforme con la propia autoimagen'],
            [1,'Bajo',49,'49 o menos','Posiblemente se aparenta tener problemas emocionales o graves','Se responde verdadero a todo lo que produce un perfil elevado','Patología exagerada-Indicada un sujeto confiado en sí mismo e independiente-Persona cínica o sarcástica'],
            [2,'Muy alto',91,'91 o más','Probablemente inválido','Respuestas al azar-Errores de calificación-Dislexia grave','Poco cooperativo, finge síntomas equivocados-Habilidad de lectura limitada-Resistencia a la prueba'],
            [2,'Alto',71,'71 a 90','Validez cuestionable','Patología fingida-Proceso psicótico-Se responde a todo "verdadero"','Súplica de ayuda-Crisis de identidad adolescente-Estado de confusión'],
            [2,'Moderado',56,'56 a 70','Probablemente válido','Deseo de mostrarse poco convencional-Compromisos políticos, sociales o religiosos fuertes-Problemas en la atención-Honestidad extrema al responder-Alteración por una crisis','Riesgo de actos agresivos,impulsivos-Persona reprimida,inquieta e inestable-Psicopatologia relativamente severa-Autocritico-Ansioso,distraido'],
            [2,'Medio',45,'45 a 55','Protocolo aceptable','Algunas creencias pueden desviarse de lo esperado','Buen funcionamiento-Respuesta común a la prueba'],
            [2,'Bajo',44,'44 o menos','Protocolo aceptable','Conformismo-Posiblemente se finge estar bien','Convencional-Sincero-Socialmente adaptado'],
            [3,'Alto',71,'71 o más','','Defensividad marcada-Se finge estar bien-Se responde a todo "falso"-Cauteloso en situaciones relacionadas con su trabajo','Sujeto tímido, inhibido, falta de involucramiento emocional-Se utiliza la negación-Falta de insight'],
            [3,'Moderado',56,'56 a 70','','Defensividad moderada-No reconocimiento de problemas','Adaptado-Autoconfianza-No dispuesto a pedir ayuda-Suficientes recursos para el tratamiento'],
            [3,'Medio',41,'41 a 55','','Equilibrio entre autoprotección y autodescubrimiento','Suficientes recursos para el tratamiento'],
            [3,'Bajo',40,'40 o menos','','Al responder finge en forma inadecuada-Responde a todo "verdadero"-Suplica ayuda-Defensas inadecuadas','Cínico,escéptico-Estado de pánico-Pobre autoconcepto-Critico de si mismo y de otros'],
        ];

        foreach ($data as $d) {
            $i = new InterValidez();
            $i->escala = $d[0];
            $i->nivel = $d[1];
            $i->identificador = $d[2];
            $i->puntuacion = $d[3];
            $i->utilidad = $d[4];
            $i->elevacion = $d[5];
            $i->interpretacion = $d[6];
            $i->save();
        }
    }
}
