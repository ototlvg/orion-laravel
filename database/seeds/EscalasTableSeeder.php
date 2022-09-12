<?php

use Illuminate\Database\Seeder;

use App\Escala;

class EscalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['L','Mentira',1],
            ['F','Infrecuencia',1],
            ['K','Correccion',1],
            ['Hs','Hipocondriasis',1],
            ['D','Depresion',1],
            ['Hi','Histeria',1],
            ['Dp','Desviacion psicotica',1],
            ['Mf','Masculino-femeneidad',1],
            ['Pa','Paranoia',1],
            ['Pt','Psicastenia',1],
            ['Es','Esquizofrenia',1],
            ['Ma','Hipomania',1],
            ['Is','Introversion social',1],
            ['A','Ansiedad',2],
            ['R','Represion',2],
            ['Fyo','Fuerza del yo',2],
            ['A-MAC','Alcoholismo de MacAndrew revisada',2],
            ['Fp','Infrecuencia posterior',2],
            ['HR','Hostilidad reprimida',2],
            ['Do','Dominancia',2],
            ['Rs','Responsabilidad social',2],
            ['Dpr','Desajuste profesional',2],
            ['GM','Genero Masculino',2],
            ['GF','Genero femenino',2],
            ['EPK','Desorden de estres postraumatico de Keane',2],
            ['EPS','Desorden de estres postraumatico de Schelenger',2],
            ['Is1','Timidez/inhibicion',2],
            ['Is2','Evitacion social',2],
            ['Is3','Alineacion - si mismo y otros',2],
            ['ANS','Ansiedad',3],
            ['MIE','Miedos',3],
            ['OBS','Obsesividad',3],
            ['DEP','Depresion',3],
            ['SAU','Preocupacion por la salud',3],
            ['DEL','Pensamiento delirante',3],
            ['ENJ','Enojo',3],
            ['CIN','Cinismo',3],
            ['PAS','Practicas antisociales',3],
            ['PTA','Personalidad tipo A',3],
            ['BAE','Baja autoestima',3],
            ['ISO','Incomodidad social',3],
            ['FAM','Problemas familiares',3],
            ['DTR','Dificultad en el trabajo',3],
            ['RTR','Rechazo al tratamiento',3]
        ];

        foreach ($data as $d) {
            $e = new Escala();
            $e->escala = $d[0];
            $e->nombre = $d[1];
            $e->tipo = $d[2];
            $e->save();
        }
    }
}
