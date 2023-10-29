let address = [
    {
        id: 1,
        name: "Ha Noi",
        lat: 21.007570,
        lon: 105.724941,
    },
    {
        id: 2,
        name: "Hai Phong",
        lat: 20.856990,
        lon: 106.680736,
    },
    {
        id: 3,
        name: "Da Nang",
        lat: 16.061102,
        lon: 108.226728,
    },
    {
        id: 4,
        name: "Ho Chi Minh",
        lat: 10.821280,
        lon: 106.649404,
    }
]
const OPEN_WEATHER_KEY = "8dde90c0c44fd4bdbd5247210fd0a65f";
const OPEN_WEATHER_API = "https://api.openweathermap.org/data/2.5/weather?lang=vi&";

$("#select-city").change(function() {
    const selectedCityId = $(this).val();
    getWeatherInfo(selectedCityId);
})

function getWeatherInfo(city_id) {
    const city = address.find(city => city.id === parseInt(city_id));
    console.log(city);
    const apiUrl = `${OPEN_WEATHER_API}lat=${city.lat}&lon=${city.lon}&appid=${OPEN_WEATHER_KEY}`;
    console.log("apiUrl",apiUrl);

    $.ajax({
        url: apiUrl,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log('response', response);
            $("#weather_icon").attr("src","https://openweathermap.org/img/wn/" + response.weather[0].icon + ".png");
            $("#address").text(response.name);
            $("#temp").text(Math.floor(response.main.temp -273.15)+ "℃");
            $("#description").text(response.weather[0].description);
            $("#feel-like").text("Cảm nhận " + Math.floor(response.main.feels_like -273.15)+ "℃");
            $("#wind-speed").text("Tốc độ gió " + response.wind.speed + "Km/h");
            $("#humidity").text("Độ ẩm " + response.main.humidity + "%");
            $("#pressure").text("Áp lực k.khí " + response.main.pressure + "hAp");
        },
        error: function() {
            console.error("Lỗi");
        }
    })
}

getWeatherInfo(1);
$(document).ready(function() {
    function updateTime() {
        const currentDate = new Date();
        const day = currentDate.getDate();
        const month = currentDate.getMonth() + 1;
        const year = currentDate.getFullYear();
        const hours = currentDate.getHours();
        const minutes = currentDate.getMinutes();

        const formattedDate = `${day}/${month}/${year} ${hours}:${minutes}`;
        $("#date").text(formattedDate);
    }

    updateTime();
    setInterval(updateTime, 1000);
});
