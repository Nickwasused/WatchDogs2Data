import React, { Component } from 'react';
import weatherdata from '../data/weather.json';
import Pagination from './pagination.jsx';

class Weather extends Component {
    constructor() {
        super();

        // an example array of items to be paged
        var weathers = weatherdata.map(i => ({ id: (i+1), name: i.weathername.toLowerCase() }));

        this.state = {
            exampleItems: weathers,
            pageOfItems: []
        };

        // bind function in constructor instead of render (https://github.com/yannickcr/eslint-plugin-react/blob/master/docs/rules/jsx-no-bind.md)
        this.onChangePage = this.onChangePage.bind(this);
    }

    onChangePage(pageOfItems) {
        // update state with new page of items
        this.setState({ pageOfItems: pageOfItems });
    }
    render() {
      return (
        <div>
            <div class="contentstart background5">
              <div class="imagefilter">;
                <table>
                  <thead>
                    <tr>
                      <td>weathername</td>
                      <td>video</td>
                  </tr>
                  <tr>
                    <td>Search using STRG+F</td>
                    <td></td>
                  </tr>
                  </thead>
                  <tbody>
                  {
                    this.state.pageOfItems.map(item =>   <tr>
                      <td>
                        <p>{item.name}</p>
                      </td>
                        <td>
                          <video controls muted>
                            <source src={"videos/webm/weather/" + item.name + ".webm"} type="video/webm"/>
                            <source src={"videos/mp4/weather/" + item.name + ".mp4"} type="video/mp4"/>
                          </video>
                        </td>
                    </tr>
                    )
                  }
                  </tbody>
                </table>
                <Pagination items={this.state.exampleItems} onChangePage={this.onChangePage} />
              </div>
            </div>
          </div>
      )
    }
  } export default Weather;