import React, { Component } from 'react';
import AsyncImage from '../asyncimage.js';

class Home extends Component {
    render() {
      return (
        <div>
            <div class="contentstart content1">
                <div class="imagefilter">
                    <a id="home"></a>
                    <h1>Watch Dogs 2</h1>
                    <h2>Game Data</h2>
                    <h3>By Nickwasused</h3>
                </div>
            </div>

            <div class="content content2">
                <div class="imagefilter">
                    <a id="characters"></a>
                    <h1>Character Models</h1>
                    <h2>List of all Watch Dogs 2 Character Models</h2>
                    <center><a href="/characters"><AsyncImage src={"images/icons/char.svg"} height="180px" width="180px"/></a></center>
                </div>
            </div>

            <div class="content content3">
                <div class="imagefilter">
                    <a id="vehicles"></a>
                    <h1>Vehicles</h1>
                    <h2>List of all Watch Dogs 2 Vehicles</h2>
                    <center><a href="/vehicles"><AsyncImage src={"images/icons/cars.svg"} height="180px" width="180px"/></a></center>
                </div>
            </div>

            <div class="content content4">
                <div class="imagefilter">
                    <a id="lmalayers"></a>
                    <h1>LMA Layers</h1>
                    <h2>List of all Watch Dogs 2 LMA Layers</h2>
                    <center><a href="lmalayers"><AsyncImage src={"images/icons/layers.svg"} height="180px" width="180px"/></a></center>
                </div>
            </div>

            <div class="content content1">
                <div class="imagefilter">
                    <a id="weathertypes"></a>
                    <h1>Weather Types</h1>
                    <h2>List of all Watch Dogs 2 Weather Types</h2>
                    <center><a href="/weather"><AsyncImage src={"images/icons/weather.svg"} height="180px" width="180px"/></a></center>
                </div>
            </div>
        </div>
      )
    }
  } export default Home;