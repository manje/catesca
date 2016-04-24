<?php

  $bd_host = 'localhost';
  $bd_basededatos = "";
  $bd_user = "";
  $bd_password = "";

  
  $titulopagina="Titulo";
  $organizacion="Nombre Organizacion";
  
  $siteadmin="";
  $home="/var/www/catesca/";
  $baseurl="http://";
  $urlreferencia="http://"; // web de la organización

  $verificaciones = Array(
  /*
      "adjunto" => Array( "cola"=>true ,  "titulo" => "Fichero/s adjuntos" , "tipo"=>"adjunto", "txt"=>"
      
      Escanee y envíenos los documentos.
      
      "),
      "email" => Array( "cola"=>true ,  "titulo" => "Envio por email" , "tipo"=>"email","txt"=>"
          
      Envíe a través del correo electrónico los documentos requeridos.
          
      ","email"=>"x@x.com"),
      "whatsapp" => Array( "cola"=>true ,  "titulo" => "Envio por whatsapp" , "tipo"=>"whatsapp","txt"=>"
      
      Haga una foto a los documentos con el móvil y envíelo por Whatsapp
      ","tel"=>"666"),
      */
      "presencial" => Array( "cola"=>false ,  "titulo" => "Presencial" , "tipo"=>"presencial","txt"=>"
      
      Diríjase con la documentación a uno de nuestros de nuestro actos.
      
      ")
   );
   $documentosvalidos = Array( 
     "dni"=>Array("name"=>"Documento Nacional de Identidad","verificable"=>true,"modificable"=>true),
     "pr"=>Array("name"=>"Permiso de Residencia","verificable"=>false,"modificable"=>false)
   );
   
   function doc_dni_verificar($doc)
   {
     if (strlen($doc) != 9 || preg_match('/^[XYZ]?([0-9]{7,8})([A-Z])$/i', $doc, $matches) !== 1) {
        return false;
     }
     $map = 'TRWAGMYFPDXBNJZSQVHLCKE';
     list(, $number, $letter) = $matches;
     return strtoupper($letter) === $map[((int) $number) % 23];
   }

   function doc_dni_modificar($doc)
   {
     $d=str_replace(" ","",$doc);
     $d=str_replace("-","",$d);
     return strtoupper($d);
   }

  $ciudad="Jerez";
  $intereses=Array(
  "Colaboraciones" => Array (
  "integra"=>"Integrarme en Ganemos Jerez",
  "org"=>"Organizar y coordinar las convocatorias",
  "asamblea"=>"Acudir a asambleas",
  "actos"=>"Acudir a actos públicos",
  "manis"=>"Acudir a manifestaciones",
  "difuinet"=>"Difundir noticias, comunicados, etc. por internet",
  "difummcc"=>"Difundir noticias, comunicados, etc. a medios de comunicación y  periodistas",
  "difuamigos"=>"Difundir noticias, comunicados, etc. a mi círculo de amigos, familia,  etc."
  
  ),
  
  "Ofrecimientos" => Array (
  "blog"=>"Tengo web y/o blog",
  "prensa"=>"Soy periodista",  
  "artista"=>"Soy artista (músicos, dibujantes, fotoógrafos, etc.)",
  "informatico"=>"Soy informático",
  "disenador"=>"Soy diseñador gráfico",
  "jurista"=>"Soy jurista",
  "audiovisual"=>"Audiovisuales",
  "espacios"=>"Espacio para actos y/o reuniones"
  ),
  
  "Intereses" => Array (
  "ddss"=>"Derechos Sociales",
  "vivienda"=>"Vivienda",
  "genero"=>"Igualdad y género",
  "salud"=>"Salud",
  "rb"=>"Renta Básica",
  "ma"=>"Medio Ambiente/Energia",
  "movilidad" => "Movilidad",
  "democracia"=>"Democracia/Participación",
  "economia"=>"Economía",
  "empleo"=>"Empleo",
  "deuda"=>"Deuda",  
  "cultura"=>"Cultura",
  "educa"=>"Educación",
  "juventud"=>"Juventud",
  "deporte"=>"Deporte",  
  "urbanismo"=>"Urbanismo",
  "patrimonio"=>"Patrimonio"
  )
);




  // No use códigos de más de 15 caracteres

  $externos=Array(
    "cyl"=>"Castilla y León",
    "and"=>"Andalucía",
    "clm"=>"Castilla-La Mancha",
    "arg"=>"Aragón",
    "ext"=>"Extremadura",
    "cat"=>"Cataluña",
    "gal"=>"Galicia",
    "val"=>"Comunidad Valenciana",
    "mur"=>"Región de Murcia",
    "ast"=>"Principado de Asturias",
    "nav"=>"Navarra",
    "mad"=>"Comunidad de Madrid",
    "can"=>"Canarias",
    "psv"=>"País Vasco",
    "can"=>"Cantabria",
    "lri"=>"La Rioja",
    "iba"=>"Islas Baleares",
    "int"=>"Internacional"
  );
  $distritos=Array(
    "norte"=>"Norte",
    "oeste"=>"Oeste",
    "centro"=>"Centro",
    "sur"=>"Sur",
    "granja"=>"Noreste/Granja",
    "delicias"=>"Este/Delicias",
    


    "albarizones"=>"Los Albarizones",
    "barca"=>"La Barca de la Florida",
    "corta"=>"La Corta",
    "cuartillos"=>"Cuartillos",
    "mojo"=>"El Mojo-Baldío de Gallardo",
    "estella"=>"Estella del Marqués",
    "gibalbin"=>"Gibalbín",
    "guadalcacion"=>"Guadalcacín",
    "guarena"=>"Puente de La Guareña",
    "ina"=>"La Ina",
    "pachecas"=>"Las Pachecas",
    "lomopardo"=>"Lomopardo",
    "majarromaque"=>"Majarromaque",
    "asta"=>"Mesas de Asta",
    "santarosa"=>"Mesas de Santa Rosa",
    "jarilla"=>"Nueva Jarilla",
    "portal"=>"El Portal",
    "rajamancera"=>"Rajamancera",
    "isidro"=>"San Isidro del Guadalete",
    "tablas"=>"Las Tablas, Polila y Añina",
    "torno"=>"El Torno",
    "torrecera"=>"Torrecera",
    "torremelgarejo"=>"Torremelgarejo",
    
    "rural"=>"Otras zonas rurales"
  );
   
  
  $txtdistritos=Array(
  "norte" => "Plaza del Caballo, Avd. Álvaro Domecq, Las Adelfas, Pintores de Jerez, Las Flores, El Bosque, Parque González Hontoria, San Joaquín, Parque de Capuchinos, Torres de Córdoba, Ceret Alto, Avd. Sudamérica, Zona Hipercor, El Altillo, Montealto, Nuevo Montealto, Albarizas de Montealto, Los Álamos de Montealto, Jacaranda, Pozoalbero, El Almendral, Edif. Huelva, Cádiz y Málaga, Polígono Santa Cruz, Ctra de Sevilla.",
  "oeste" => "Picadueña Alta, Picadueña Baja, San Valentín, Las Torres, Sagrada Familia, El Carmen, La Plata, Calle Lealas, Eduardo Delage, La Coronación, Parque de la Serrana, Icovesa, Juan XXIII, Los Naranjos, San Juan de Dios, El Calvario, Polígono San Benito, San Ginés de la Jara, Avd. de la Cruz Roja, La Unión.",
  "centro" => "San Mateo, San Juan, San Marcos, San Dionisio, San Lucas, Catedral-El Salvador, Divina Pastora, La Constancia, España, San Pedro, Pío XII, Plaza de la Estación, Vallesequillo, Calle Porvenir, San Telmo, Cerrofuerte, Plaza de las Angustias, La Alegría, San Miguel, Calle Corredera, Calle Cerrón, Plaza San Andrés, Plaza Aladro, Puerta Sevilla, Madre de Dios, Avda. Álvaro Domecq, Calle Ávila, Calle Matadero, Soto Real, Santiago, Calle Asta, Calle Taxdirt.",
  "sur" => "Estancia Barrera, Vista Alegre, Agrimensor, Torresoto, Residencial Cartuja, Hijuela de las Coles, Federico Mayo, Polígono San Telmo, Cerrofruto, Calle Mandamiento Nuevo, San Telmo Nuevo, Liberación, polígono El Portal, Constitución, Avd. Alcalde Cantos Ropero, Vallesequillo II, Blas Infante, Santo Tomás de Aquino, Puertas del Sur, Plaza Luis Parada, Plaza José Guerra Carretero, Torres del Sur, Parque Empresarial Oeste, Guadabajaque, Matacardillo.",
  "granja" => "El Pelirón, Hacienda El Polo, Torresblancas, Nuevo Chapín, Santo Ángel de la Guarda, San José Obrero, La Granja, San Enrique, Los Pinos, Chapín, La Marquesa, La Sierra, El Ángel, Jerez Norte, La Cañada, Edif. Congreso I y II Avd. Lola Flores, Santa Teresa, Avd. Europa.",
  "delicias" => "Paseo de las Delicias, La Vid, Las Viñas, Zafer, La Asunción, Olivar de Rivero, Nazaret, Ciudasol, El Retiro, Princijerez, Las Palmeras, Los Infantes, Los Cedros, Barbadillo, Nueva Andalucía, Montealegre, Pago San José, Parque Atlántico, La Canaleja, El Pimiento, La Pita, El Pinar, El Rocío, La Milagrosa, Guernica, Bami, Villa del Este, Pago Majón, Parque Cartuja, Bahía, Nazaret Este, Edif. Santa Rosa, Avd. Medina Sidonia."

  );
  


$HerramientasParticipacion=Array(
  "vota"=>Array(
    "name"=>"Votación",
    "modulo"=>"votacion", // se puede llamar a esta herramienta mediante /votacion/{$id}/
    "postconf"=>true      // esto hace que después de creado se redirija a /votacion/{$id}/postconf/ para terminar de configurar (el módulo debe comprobar que quien llega a ese url es el creador)
  ),
  "gtrabajo"=>Array(
    "name"=>"Grupo de Trabajo",
    "modulo"=>"gtrabajo"
  ),
  "gexpertos"=>Array(
    "name"=>"Grupo de Expertos",
    "modulo"=>"gexpertos"
  )
);

