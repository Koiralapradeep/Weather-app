async function fetchData() {
    const response = await fetch('https://api.openweathermap.org/data/2.5/weather?q=florence&appid=3d5bd33ba5b064887a6caeb6725df952');
    const data = await response.json();
    console.log(data)
    const cityname = document.getElementById("cityname")
    cityname.innerHTML = data.name
    const country = document.getElementById("country")
    country.innerHTML = data.sys.country
    const temp = document.getElementById("value")
    const tempInCelsius = (data.main.temp - 273).toFixed(2);
    const humidity = document.getElementById("humidity");
    const humidityValue = data.main.humidity;
    humidity.innerHTML = `Humidity: ${humidityValue}%`;
    const iconCode = data.weather[0].icon;
    const iconUrl = `http://openweathermap.org/img/wn/${iconCode}.png`;
    const iconElement = document.getElementById('icon');
    iconElement.src = iconUrl;
    const speed = document.getElementById("windspeed")
    speed.innerHTML = `Wind: ${data.wind.speed}m/s`;
    const pressure = document.getElementById("press")
    pressure.innerHTML = `Press: ${data.main.pressure} hpa`;
    temp.innerHTML = `${tempInCelsius} &deg;C`;
    const description = document.getElementById("seasons")
    const desc = data.weather[0].description.charAt(0).toUpperCase() + data.weather[0].description.slice(1).toLowerCase();
    description.innerHTML = desc;
    const unixTimestamp = data.dt;
    const dateElement = document.getElementById('date');
    const date = new Date(unixTimestamp * 1000);
    const calender = { month: 'long', day: 'numeric', year: 'numeric' };
    const dateString = date.toLocaleDateString('en-uk', calender);
    dateElement.innerHTML = dateString;
  }
  
  fetchData()

  const SearchBar = document.getElementById("form")
  SearchBar.addEventListener("click", async function(e) {
    e.preventDefault()
    const searchfield = document.getElementById("search").value
    console.log(searchfield)
    const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${searchfield}&appid=3d5bd33ba5b064887a6caeb6725df952`);
    const data = await response.json();
    console.log(data)
    const cityname = document.getElementById("cityname")
    cityname.innerHTML = data.name
    const country = document.getElementById("country")
    country.innerHTML = data.sys.country
    const unixTimestamp = data.dt;
    const temp = document.getElementById("value")
    const tempInCelsius = (data.main.temp - 273).toFixed(2);
    temp.innerHTML = `${tempInCelsius} &deg;C`;
    const description = document.getElementById("seasons")
    const desc = data.weather[0].description.charAt(0).toUpperCase() + data.weather[0].description.slice(1).toLowerCase();
    description.innerHTML = desc;
    const humidity = document.getElementById("humidity");
    const humidityValue = data.main.humidity;
    humidity.innerHTML = `Humidity: ${humidityValue}%`;
    const iconCode = data.weather[0].icon;
    const iconUrl = `http://openweathermap.org/img/wn/${iconCode}.png`;
    const iconElement = document.getElementById('icon');
    iconElement.src = iconUrl;
    const speed = document.getElementById("windspeed")
    speed.innerHTML = `Wind: ${data.wind.speed}m/s`;
    const pressure = document.getElementById("press")
    pressure.innerHTML = `Press: ${data.main.pressure} hpa`;
    const dateElement = document.getElementById('date');
    const date = new Date(unixTimestamp * 1000);
    const calender = { month: 'long', day: 'numeric', year: 'numeric' };
    const dateString = date.toLocaleDateString('en-uk',calender);
    dateElement.innerHTML = dateString;
  })