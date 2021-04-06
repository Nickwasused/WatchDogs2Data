import React, { Component, Suspense, lazy } from "react";
import weatherdata from '../data/weather.json';

const Pagination = lazy(() => import('./pagination.jsx'));
const Weatherobject = lazy(() => import('./subcomponents/weatherobject.jsx'));

class Weather extends Component {
    constructor() {
        super();

        // an example array of items to be paged
        var weathers = weatherdata.map(i => ({ id: (i+1), name: i.weathername }));

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
                  <Suspense fallback={<div>Loading...</div>}>
                    {
                      this.state.pageOfItems.map(item =>
                        <Weatherobject {...item} key={item.name}/> 
                      )
                    }
                  </Suspense>
                  </tbody>
                </table>
                <Suspense fallback={<div>Loading...</div>}>
                <Pagination items={this.state.exampleItems} onChangePage={this.onChangePage} />
              </Suspense>
              </div>
            </div>
          </div>
      )
    }
  } export default Weather;