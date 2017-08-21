/* music.js */

window.spotify_prefix = "<iframe src='https://embed.spotify.com/?uri=spotify:user:";
window.spotify_view = "view=list";
window.spotify_suffix = "&" + window.spotify_view + "' width='400' height='250' frameborder='0' allowtransparency='true'></iframe>";

function turnOnMusic()
{
	if(window.musicSource == 'lastfm')
	{
		window.musicScript = "";
	}
	else if(window.musicSource == 'grooveshark')
	{
		window.musicScript = "";
	}
	else if(window.musicSource == 'spotify')
	{
		window.spotifyUserName = getSpotifyUserName(window.musicEmbedCode);
		window.spotifyUserPlaylistID = getSpotifyUserPlaylistID(window.musicEmbedCode);

		window.musicScript = window.spotify_prefix + window.spotifyUserName + ":playlist:" + window.spotifyUserPlaylistID +  window.spotify_suffix;

	}
	else
	{
		window.musicScript = "";
	}
	return window.musicScript;
}

function turnOffMusic()
{
	window.musicScript = "Music is turned off. <a href='../account?tab=settings'>Turn On</a>.";
	return musicScript;
}

function getSpotifyUserName(embedCode)
{
	var splitArray = embedCode.split("/");
	return splitArray[4];
}

function getSpotifyUserPlaylistID(embedCode)
{
	var splitArray = embedCode.split("/");
	return splitArray[splitArray.length-1];
}