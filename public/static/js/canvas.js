// // // Ep.1
// //
// var canvas= document.querySelector('canvas')
// //
// // Tamaño del Canvas
// canvas.width= window.innerWidth;
// canvas.height= 400;
// //
// var c= canvas.getContext('2d')
// //
// // // c.fillRect(x,y,width,heigh) -- El punto de referencia es la esquina superior izquierda del CANVAS DEL CUADRO DEL CANVAS NO DEL VIEWPORT
// //                                 // Es exactamente igual a position (cuando hablemos de y es como si estuvieramos hablando de top)
// //
// //
// // c.fillStyle= 'rgba(21,72,203,1)'; // Le da color al cuadrado/rectangulo
// // c.fillRect(0,0,350,400) // -- Esto agregar un rectangulo/cuadrado
// //
// //
// // // c.fillStyle= 'rgba(203,190,21,1)'
// // // c.fillRect(100,0,100,100) // -- Esto agregar un rectangulo/cuadrado
// //
// // // for(let i=0; i<100;i++){
// // //     c.fillRect(i,0,100,100) // -- Esto agregar un rectangulo/cuadrado
// // //     i+=100
// // // }
// //
// //
// //
// // // Ep.2
// // // We can draw
// // // Reactangles,Lines,Arcs/Circles,Bezier Curves, Images, Text
// // // We are gonna to check only the first 3
// //
// // // Line
// //
// // c.beginPath()
// // c.moveTo(50,300) // En donde se pondra el primer punto
// // c.lineTo(300,100) // Punto siguiente
// // c.lineTo(400,350) // Punto siguiente
// // c.strokeStyle="black"
// // // c.strokeStyle="#fa34a3" // Colorear la linea que se dibujara
// // c.stroke() // Este comando une los puntos formando una linea
// //
// // // Arc/Circle
// // // c.arc(x,y,radius,startAngle,endAngle,anticlockwise) // 'x' y 'y' son apartir del radio del circulo
// //
// // c.beginPath() // Se pone el beginingPath() de nuevo para separarlo de los puntos del codigo anterior, si no lo ponemos se va a juntar este dibujo con el otro, es como en illustrator cuando hacemos varios puntos con la pluma, y ya cerramos todos los puntos y queremos dibujar otra cosa, PERO al momento de poner el otro punto se conecta con el que ya habiamos cerrado segun
// // c.arc(350,350,30,0,(Math.PI*2),false)
// // c.strokeStyle='red'
// // c.stroke()
//
// // c.beginPath() // Se pone el beginingPath() de nuevo para separarlo de los puntos del codigo anterior, si no lo ponemos se va a juntar este dibujo con el otro, es como en illustrator cuando hacemos varios puntos con la pluma, y ya cerramos todos los puntos y queremos dibujar otra cosa, PERO al momento de poner el otro punto se conecta con el que ya habiamos cerrado segun
// // c.arc(200,200,30,0,(Math.PI*2),false)
// // c.strokeStyle='black'
// // c.stroke()
//
// var x=0
// var y=200
// var vel=5
// var reversa=false
// function animate(){
//     requestAnimationFrame(animate)
//     c.clearRect(0,0,innerWidth,innerWidth)
//     c.beginPath() // Se pone el beginingPath() de nuevo para separarlo de los puntos del codigo anterior, si no lo ponemos se va a juntar este dibujo con el otro, es como en illustrator cuando hacemos varios puntos con la pluma, y ya cerramos todos los puntos y queremos dibujar otra cosa, PERO al momento de poner el otro punto se conecta con el que ya habiamos cerrado segun
//     c.arc(x,y,30,0,(Math.PI*2),false)
//     c.strokeStyle='black'
//     c.stroke()
//     // console.log(!(x<=window.innerWidth))
//     // console.log(x)
//     // x++
//     if(x<innerWidth && !reversa){
//         x+=vel
//     }else{
//         reversa=true
//         if(x>0){
//             x-=vel
//         }else{
//             reversa=false
//         }
//     }
// }
//
// animate()


var data = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86, 27, 90]
        }
    ]
};

var options = {
    scaleShowGridLines : true,

}

var ctx = document.getElementById("myChart").getContext("2d");
var myLineChart = new Chart(ctx).Line(data, options);
