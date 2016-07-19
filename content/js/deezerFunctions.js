/**
 * Created by Abdel on 03/12/2014.
 */
    // on grise les boutons par défaut (etre sur que Deezer API a bien été initialisée avant de lancer quoique soit
$(document).ready(function(){
    $("#controlers input").attr('disabled', true);
});


// on dégrise les boutons une fois que Deezer API est initialisé
function onDeezerLoaded() {
    $("#controlers input").attr('disabled', false);
}


// trouve l'id du genre de l'album passé en parametre
// et appelle incCountGenres() pour incrémenter le nb d'albums correspondant à ce genre
function getGenreAlbum(albumid) {

    DZ.api('/album/'+albumid, function(response){
        gid=response.genre_id;
        tabCountGenres[gid]=tabCountGenres[gid]+1;
        nbAlbumsComptes = nbAlbumsComptes+1; // indicateur qui dit si on a parcouru tous les albums favoris ou pas

        if (nbAlbumsComptes==nbAlbumsFavoris) {

            console.log('nbAlbumsComptes='+nbAlbumsComptes);



        }
    });

}


// recupere tous les albums favoris du user
function getFavoriteAlbums(){

    DZ.api('/user/'+user_id+'/albums', function(response){
        var i;
        nbAlbumsFavoris = response.data.length;
        //console.log('nb albums favoris ='+nbAlbumsFavoris);
        for(i in response.data){
            album_id = response.data[i].id;
            //console.log("album id : "+album_id);
            getGenreAlbum(album_id);
        }

    });

}

// vérifie le status du user : loggué ou pas sur Deezer ?
// si loggué appelle GetUserInfo pour récupérer et stocker les infos user
// si pas loggué appelle Login() pour se logguer et autoriser permissions
function getStatus(){

    DZ.getLoginStatus(function(response) {
        if (response.authResponse) {
            console.log('already logged / user id ='+response.userID);
            user_id=response.userID;
            getUserInfos();
        } else {
            console.log('not logged yet');
            login();
        }
    });
}


// récupère les infos (email, nom, pays etc) du user en cours
// également récupère les albums favoris et genre favoris
// (tout ceci sera ensuite inséré en BDD dans une autre opération)
function getUserInfos(){

    DZ.api('/user/'+user_id, function(response){

        // on récupère les champs du user
        birthday = response.birthday;
        country = response.country;
        id = response.id;
        email = response.email;
        gender = response.gender;
        lang = response.lang;
        status = response.status;
        firstname = response.firstname;
        lastname = response.lastname;

        donnees="birthday="+birthday+"&firstname="+firstname+"&lastname="+lastname+"&email="+email+"&country="+country+"&id="+id+"&gender="+gender+"&lang="+lang+"&status="+status+"";
        //console.log(donnees);

        getFavoriteAlbums();


    });
}


// lance la procédure (pop up) de login à Deezer
// dans la foulée, si ca n'a pas été fait, Deezer demande la permission pour l'application d'accéder aux coordonnées, playlist etc.
// Si login ok, on récupère dans la foulée les infos user via l'opération getStatus()
function login(){
    DZ.login(function(response) {
        if (response.authResponse) {
            console.log('Login successfull / user id = '+response.userID);
            user_id=response.userID;

            /*getUserInfos(); 			// ne marche pas : on n'a que des "undefined" sur les valeurs, il semble falloir repasser par un getStatus ??
             getStatus();	*/		 	// ne marche pas non plus : il semble qu'il faille attendre un peu avant de pouvoir recevoir les infos user ??
            setTimeout(getStatus,2000); // d'où solution : provoquer l'execution de getStatus dans un délai de 2 secondes.

        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, {perms: 'email,offline_access,manage_library,manage_community,delete_library'});
}



// --------------------------------
// variables globales

var user_id=0;
var nbAlbumsComptes = 0; // indicateur qui dit si on a parcouru tous les albums favoris ou pas
var nbAlbumsFavoris = 0;
var donnees="";

var tabNomGenres = {"0" : "Tous", "85" : "Alternative", "98" : "Classique", "113" : "Dance", "106" : "Electro", "173" : "Films-Jeuxvideo", "51" : "France", "116" : "Hip-Hop", "129" : "Jazz", "95" : "Musique-pour-enfants", "132" : "Pop", "165" : "RnB-Soul-Funk", "144" : "Reggae", "152" : "Rock", "1" : "World"};

var tabCountGenres = { "0" : 0, "85" : 0, "98" : 0, "113" : 0, "106" : 0, "173" : 0, "51" : 0, "116" : 0, "129" : 0, "95" : 0, "132" : 0, "165" : 0, "144" : 0, "152" : 0, "1" : 0};


DZ.init({
    appId  : '119605',
    //appId  : '8',
    channelUrl : 'http://www.livespot.fr/deezerapp/channel.php',
    //channelUrl : 'http://developers.deezer.com/examples/channel.php',
    player : {
        // player invisible : on laisse juste l'événement de callback
        container : 'player',
        cover : true,
        playlist : true,
        width : 650,
        height : 300,
        onload : onDeezerLoaded
    }
});


// -----------------------------------------------------------------
$(document).ready(function(){
    $("#controlers input").attr('disabled', true);
    $("#slider_seek").click(function(evt,arg){
        var left = evt.offsetX;
        console.log(evt.offsetX, $(this).width(), evt.offsetX/$(this).width());
        DZ.player.seek((evt.offsetX/$(this).width()) * 100);
    });
});
function event_listener_append() {
    var pre = document.getElementById('event_listener');
    var line = [];
    for (var i = 0; i < arguments.length; i++) {
        line.push(arguments[i]);
    }
    pre.innerHTML += line.join(' ') + "\n";
}
function onPlayerLoaded() {
    $("#controlers input").attr('disabled', false);
    event_listener_append('player_loaded');
    DZ.Event.subscribe('current_track', function(arg){
        event_listener_append('current_track', arg.index, arg.track.title, arg.track.album.title);
    });
    DZ.Event.subscribe('player_position', function(arg){
        event_listener_append('position', arg[0], arg[1]);
        $("#slider_seek").find('.bar').css('width', (100*arg[0]/arg[1]) + '%');
    });
}