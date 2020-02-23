var cuentaAudio = 1;

function cargaAudios() {
    
    $.getJSON("./sql/selectAudioGestor.php", { cuenta: cuentaAudio }).done(function(data)  {
        
        var tmpl = document.getElementsByTagName('template')[0];
        var audioPlay = tmpl.content.querySelector("#audioPlay");
        var divFecha = tmpl.content.querySelector("#fecha");
        var divborrarAudio = tmpl.content.querySelector("#borrarAudio");        
            
        $.each(data, function(i, item) {  
                       
            var archivo = data[i]['name'];

            audioPlay.src = data[i]["path"];
            divFecha.innerText = data[i]["fechaMostrar"];                        
            divborrarAudio.innerHTML = '<img src="./img/borrar.png" onclick="borrarAudio('+archivo+')">';

            var clon = tmpl.content.cloneNode(true);
            document.getElementById('containerPlay').appendChild(clon);
        });
                
    }).fail(function(jqXHR, textStatus, error) {			

		console.log("Error de la aplicación: " + error);    			
		$(body).append("Error al cargar audios: " + error);			
		});        
}

function borrarAudio(path) {
    
    alert(path);
	// $.post("./sql/deleteAudioGestor.php", { cuenta: cuentaAudio, path: path })
	// .done(function(data) {		
	// 	cargaAudios();
	// }).fail(function(jqXHR, textStatus, error) {
	// console.log("Error de la aplicación: " + error);    			
	// $(body).append("Error al conectar con la base de datos: " + error);			
	// });
}