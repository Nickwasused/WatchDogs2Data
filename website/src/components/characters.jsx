import React, { Component } from 'react';
import AsyncImage from '../asyncimage.js';
import characterdata from '../data/characters.json';
import Pagination from './pagination.jsx';

class Characters extends Component {
  constructor() {
        super();

        // an example array of items to be paged
        var models = characterdata.map(i => ({ id: (i+1), name: i.modelname.toLowerCase() }));

        this.state = {
            exampleItems: models,
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
          <div class="contentstart content3">
            <div class="imagefilter">
              <table>
                <thead>
                  <tr>
                    <td>modelname</td>
                    <td>image</td>
                  </tr>
                  <tr>
                    <td>Search using STRG+F</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                {
                  this.state.pageOfItems.map(item =>    <tr>
                    <td>
                      <p>{item.name}</p>
                    </td>
                    <td>
                      <AsyncImage src={"images/webp/models/" + item.name + ".webp"}/>
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
  } export default Characters;