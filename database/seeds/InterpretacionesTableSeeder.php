<?php

use Illuminate\Database\Seeder;

use App\Interpretacion;

class InterpretacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [4,1,'Puede tratarse de una persona esquizoide, con las fantasías o delirios corporales extraños-Puede estar limitado, inmovilizado por múltiples síntomas y quejas'],
            [4,2,'Pueden darse reacciones exageradas a algunos problemas reales-El sujeto puede estar extremadamente centrado en sí mismo y ser egoísta-Puede ser mordaz o demandante, tener una manera cínica de ver las cosas-Pueden manifestarse actitudes derrotistas o pesimismo-Se puede manifestar exageración de los problemas físicos o quejas múltiples-Inestabilidad'],
            [4,3,'Se pueden presentar desórdenes orgánicos específicos-El sujeto puede ser quejumbroso, irritable, llorar fácilmente o ser inmaduro-La persona puede tener excesivo interés o preocupaciones por la salud personas, las dietas, el peso y el funcionamiento corporal'],
            [4,4,'Se manifiesta poco o ningún interés especial acerca del cuerpo o de la salud-La persona es emocionalmente abierta y equilibrada, así como realista y con capacidad de insight'],
            [4,5,'Puede presentarse cuando se niegan signos o síntomas de enfermedad-Puede tratarse también de personas optimistas y energéticas que pueden ser además capaces y eficientes'],
            [5,1,'Puede implicar que se trata de un sujeto retraído, abrumado por los problemas o desesperanzado-Puede indicar también sentimientos de culpa, devaluación e inadecuación-El sujeto puede además estar preocupado por la muerte y el suicidio-Se puede relacionar también con abatimiento y lentitud en el pensamiento y la acción'],
            [5,2,'Se puede presentar en personas retraídas, cautelosas y distantes de los demás-Puede indicar también tristeza, falta de energía, incapacidad para concentrarse, así como molestias físicas e insomnio-Puede implicar además poca confianza en sí mismo, sentimientos de inadecuación y tendencia a autorreproches constantemente-El sujeto puede estar angustiado, además de sentirse miserable y desdichado'],
            [5,3,'Puede indicar que se trata de un sujeto inhibido, irritable, timido y reprimido-También puede manifestar desaliento, melancolía, infelicidad, así como insatisfacción consigo mismo o con el mundo-Puede ser además pesimista y preocupado en exceso-Puede presentarse en personas introvertidas y moralistas así com responsables y modestas'],
            [5,4,'Indica que se trata de una persona conforme consigo misma-Puede ser también un sujeto estable, equilibrado y realista'],
            [5,5,'Se puede presentar en una persona activa y entusiasta, así como alegre y optimista-Puede ser desinhibida y socialmente abierta-Puede estar libre de problemas emocionales y mostrar confianza en sí mismo'],
            [6,1,'Puede implicar una persona fácilmente influenciable-Ansiedad repentina y episodios de pánico-Sujeto desinhibido o caprichoso-Conductas infantiles ante la frustración-Se puede reaccionar a los problemas emocionales desarrollando síntomas físicos'],
            [6,2,'Se presenta en personas que utilizan como defensas la negación y la disociación-Implica síntomas y quejas funcionales específicas-El Sujeto puede ser ingenuo, con poca capacidad de insight-También puede ser inquieto, demandante e histriónico'],
            [6,3,'Se da en individuos centrados en sí mismos y superficiales, con cierta inmadurez y tendencia a manipular a los demás-El sujeto puede ser convencional y moralista-Puede implicar necesidad de ser querido e inseguridad-Se presenta en personas extravertidas y expresivas'],
            [6,4,'Se presenta en personas realistas y sensibles-El sujeto puede ser además equilibrado y razonable'],
            [6,5,'Se da en personas cínicas o agresivas-Puede implicar también aislamiento y poco interés en los demás-Personas con pocos intereses'],
            [7,1,'Se presenta en personas que tienen poca capacidad de juicio-Puede indicar inestabilidad e irresponsabilidad en un sujeto inmaduro y centrado en sí mismo-Se pueden presentar conductas antisociales-Puede tratarse de un individuo agresivo o explotador'],
            [7,2,'Se puede deber a poca tolerancia, al aburrimiento o tedio-Problemas con la autoridad-Problemas maritales y de trabajo recurrentes-Puede tratarse de un sujeto rebelde y hostil-Puede indicar relaciones interpersonales y reacciones emocionales superficiales, ausencia de culpa o remordimiento-Se pueden presentar adicciones-El sujeto puede tener antecedentes de pocos logros'],
            [7,3,'Puede tratarse de una persona impulsiva y aventurera, en cierta medida hedonista-El sujeto puede ser resentido, poco confiable e impaciente-Por otra parte puede tratarse de un individuo sociable, confiando en sí mismo, que expresa claramente sus opiniones y sentimientos-Puede ser una persona imaginativa y creativa'],
            [7,4,'Puede ser una persona sincera, confiable, tensa y responsable'],
            [7,5,'El individuo puede ser convencional y rígido-Puede indicar poca confianza en sí mismo y pasividad-El sujeto puede ser moralista-indica también capacidad de autocrítica o un control de impulsos exagerado'],
            [8,1,'Intereses tradicionalmente femeninos-Posibles conflictos de identidad sexual-Pasividad y actitudes afeminadas-Inseguro en la expresión de sus emociones y opiniones-Posibles tendencias homoeróticas'],
            [8,2,'El sujeto muestra interés de investigación y creatividad-Tolera otros puntos de visa-Puede ser individualista-Con capacidad de empatía'],
            [8,3,'Sujeto autocontrolado con sentido común-Expresivo y demostrativo con intereses estéticos-Muestra sensibilidad en las relaciones interpersonales'],
            [8,4,'Sujeto práctico y despreocupado-También puede ser realista y convencional'],
            [8,5,'Intereses tradicionalmente masculinos-Actitudes machistas-Puede ser un sujeto rudo, imprudente y agresivo-Sujeto orientado a la acción y confiado en sí mismos-Sus intereses pueden ser limitados'],
            [44,6,'Pocos intereses femeninos tradicionales-Puede ser una persona poco amable, dominante o agresiva'],
            [44,7,'La persona se muestra confiada en sí misma-Puede ser competitiva y enérgica-Puede mostrar cierta frialdad emocional-Se guía por la lógica'],
            [44,8,'Persona activa y arriesgada-Muestra espontaneidad-Es capaz de expresar con claridad y firmeza sus sentimientos y puntos de vista'],
            [44,4,'Persona capaz y eficiente-Considerada con los demás, empática y de trato fácil-Idealista'],
            [44,5,'Intereses femeninos tradicionales-Tendencia a la inseguridad y autodevaluación-Puede ser pasiva, dependiente y sumisa-Persona autocompasiva y quejumbrosa-Constreñida y dependiente-Se siente incapaz'],
            [9,1,'Puede indicar alteración del pensamiento-Creencias equivocadas-Ideas de referencia-El sujeto puede ser vengativo y preocupado-La persona puede actuar con base en delirios o fantasías'],
            [9,2,'El sujeto puede ser violento y resentido-Puede proyectar la culpa y las críticas-Es una persona hostil y suspicaz-Indica rigidez y obstinación-Tendencia a interpretar mal las situaciones sociales'],
            [9,3,'Sujeto demasiado sensible a desaires y rechazos-Se muestra cauteloso en los contactos sociales iniciales-Puede ser moralista y actuar como víctima-Confiado hasta que lo traicionan-Muy trabajador'],
            [9,4,'El sujeto muestra un pensamiento claro y actúa racionalmente-Se Presenta en personas precavidas y flexibles'],
            [9,5,'Puede tratarse de un sujeto equilibrado y jovial-La persona puede ser cautelosa y evasiva-Puede ser un sujeto obstinado-Sugiere desorden paranoide'],
            [10,1,'Puede indicar un sujeto meditativo-Rituales rígidos-La persona puede estar perturbada o presentar fobias basadas en ideas supersticiosas-El sujeto puede ser temeroso o presentar sentimientos de culpa-Puede presentarse en individuos angustiados y depresivos'],
            [10,2,'El sujeto puede ser inseguro, preocupado y ansioso-La persona puede ser aprensiva y tener miedo al fracaso-Puede tratarse de un individuo extremadamente meticuloso e indeciso-Se presenta también en personas moralistas, tenaz e infelices'],
            [10,3,'Puede tratarse de un sujeto responsable y acucioso, que tiene a intelectualizar-Muy trabajador-Ordenado y perfeccionista-Autocrítico o introspectivo'],
            [10,4,'Se presenta en personas puntuales y confiables-El sujeto puede ser adaptable y confiado-Indica también una persona bien organizada'],
            [10,5,'La persona confía en sí misma-Se siente libre de inseguridades, relajado y tranquilo-Puede ser además tenaz y eficiente'],
            [11,1,'Puede indicar alteraciones del pensamiento y conductas excéntricas-Se puede tratar de un sujeto aislado socialmente-El contacto con la realidad puede ser pobre y manifestarse tendencias delirantes-Puede darse en personas que presentan alucinaciones y autismo'],
            [11,2,'La persona puede manifestar creencias raras o realizar acciones grotescas-El sujeto puede ser retraído, alienado y poco convencional-Puede además dudar de si mismo y estar confundido con respecto a su identidad-Pueden manifestarse dofofciltades en la concentración y el pensamiento'],
            [11,3,'Poco interés en la gente-El sujeto puede ser creativo e imaginativo, además de poco práctica-Puede manifestar también preocupaciones religiosas-Se puede presentar en personas irritables'],
            [11,4,'Se trata de personas adaptables, confiables y equilibradas'],
            [11,5,'El sujeto puede ser convencional y conservador-Autocontrolado-Sumiso'],
            [12,1,'Los sujetos pueden ser comunicativos, irritables y extravagantes-La persona puede ser también hiperactiva y dispersa-El individuo puede estar confuso, tomar decisiones impulsivas y mostrar poco control de sus emociones'],
            [12,2,'La persona puede ser demasiado abierta y mostrar actividad excesiva-Puede estar eufórico, agitado y presentar labilidad emocional-Puede ser una persona muy platicadora con relaciones interpersonales superficiales e impaciente'],
            [12,3,'Se presenta en personas dóciles y tolerantes-El sujeto puede tener poca tolerancia a la monotonía y una amplia variedad de intereses-Puede tratarse de una persona eficiente y trabajadora, emprendedora y orientada al logro'],
            [12,4,'Puede tratarse de un sujeto sociable y amigable-Se presenta en personas responsables y realistas-Individuos entusiastas y equilibrados'],
            [12,5,'El sujeto puede ser apático y pesimistas-Tímido y dependiente-Falta de energía con poca confianza en sí mismo-Puede estar deprimido y fatigarse fácilmente'],
            [13,1,'Las personas pueden ser aisladas, distantes y retraídas-Puede tratarse de sujetos meditativos, inseguros e indecisos'],
            [13,2,'Puede tratarse de individuos introvertidos, tímidos y cautelosos-La persona puede ser irritable y malhumorada, con poca confianza en sí misma-El sujeto puede ser sumiso o rígido'],
            [13,3,'Puede ser reservado y serio-Las personas pueden ser autoevaluadas y cautelosas, con un control exagerado de sus impulsos-El individuo puede ser reservado y torpe socialmente'],
            [13,4,'Puede tratarse de sujetos enérgicos y activos, con entereza-La persona puede ser equilibrada, amistosa y plativadora'],
            [13,5,'Sujetos sociales, cálidos y dóciles-La persona puede ser exhibicionista o manipuladora-Puede tener confianza en sí mismo y ser autoafirmativo-Algunos individuos son demasiado tolerantes con ellos mismos'],
        ];

        foreach ($data as $d) {
            $i = new Interpretacion();
            $i->escala = $d[0];
            $i->nivel = $d[1];
            $i->interpretacion = $d[2];
            $i->save();
        }

    }
}
