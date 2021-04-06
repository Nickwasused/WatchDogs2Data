import React, { Component, Suspense, lazy } from "react";
import lmalayerdata from '../data/lmalayers.json';

const Pagination = lazy(() => import('./pagination.jsx'));
const Lmaobject = lazy(() => import('./subcomponents/lmalayerobject.jsx'));

class Lmalayers extends Component {
  constructor() {
        super();

        // an example array of items to be paged
        var lmalayers = lmalayerdata.map(i => ({ id: (i+1), name: i.lmalayer.toLowerCase() }));

        this.state = {
            exampleItems: lmalayers,
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
                <Suspense fallback={<div>Loading...</div>}>
                {
                  this.state.pageOfItems.map(item =>
                    <Lmaobject {...item} key={item.name}/>
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
  } export default Lmalayers;