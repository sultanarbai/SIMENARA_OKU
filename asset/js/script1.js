var city = "Indonesia";


$.getJSON("http://api.openweathermap.org/data/2.5/weather?q="+ city +"&unit=imperial&APPID=28eac9c315ed1dfae41343d0aacc7c9e", function(data){
	console.log(data);

	var icon = "https://openweathermap.org/img/w/" + data.weather[0].icon + ".png";
	var temp = Math.floor(data.main.temp);
	var weather = data.weather[0].main;
	var name = data.name;
	var wind = data.wind.speed;


	$('.icon').attr("src", icon);
	$('.weather').append(weather);
	$('.temp').append("temp -> " +temp);
	$('.name').append("negara -> "+name);
	$('.wind').append("kec.angin -> "+wind);
});