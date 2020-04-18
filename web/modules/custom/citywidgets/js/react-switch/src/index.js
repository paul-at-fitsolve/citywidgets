// Import not needed because React & ReactDOM are loaded by *.libraries.yml
// import React from 'react';
// import ReactDOM from 'react-dom';

const divStyle = {
  margin: '0 auto',
  padding: '10px',
};

const widgetStyle = {
  margin: '0 auto',
  padding: '10px',
  width: '500px',
  height: '500px',
  backgroundImage: 'url(/modules/custom/weather-icon-png-11071.png)',
  backgroundRepeat: 'no-repeat'
};
const iconStyle = {
  margin: '80px auto',
  width: '100px',
  textAlign: 'center'
};
const textStyle = {
  fontSize: '1.5em',
  textAlign: 'center'
}
const buttonStyle = {
  width: '100%'
}
const imageStyle = {
  width: '100px'
}
class WeatherWidget extends React.Component {

  constructor() {
    super();
    this.state = {
      checked: true,
    };
    this.handleCheck = this.handleCheck.bind(this);
    }
  handleCheck() {
    this.setState({ checked: !this.state.checked });
  }

  render() {
    return (
      <div style={divStyle}>
        <div style={widgetStyle}>
          <div style={iconStyle}>
            <h1>{this.props.weatherData.city}</h1>
            <img style={imageStyle} src={"http://openweathermap.org/img/w/" + this.props.weatherData.icon + ".png"}></img>
            {this.state.checked === false &&
              <p style={textStyle}>{Math.ceil(this.props.weatherData.temperature * 9 / 5 + 32) + "\u2109"}</p>
            }
            {this.state.checked === true &&
              <p style={textStyle}>{Math.ceil(this.props.weatherData.temperature) + "\u2103"}</p>
            }
            <label className="switch">
              <input type="checkbox" onChange={this.handleCheck} />
              <span className="slider round"></span>
            </label>
          </div>
        </div>
      </div>
    )
  }
}

ReactDOM.render(
  <WeatherWidget
    weatherData={drupalSettings.weather_data}
  />,
  document.getElementById('react-weather-app')
);
