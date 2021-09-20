import {
  HashRouter as Router,
  Switch,
  Route,
  NavLink
} from 'react-router-dom';
import React, { Suspense, lazy } from "react";
import './styles/App.css';

const Home = lazy(() => import('./components/home'));
const Vehicles = lazy(() => import('./components/vehicles'));
const Characters = lazy(() => import('./components/characters'));
const Lmalayers = lazy(() => import('./components/lmalayers'));
const Weather = lazy(() => import('./components/weather'));

function App() {
  return (
    <div className="App">
      <div>
      <Router>
        <nav>
          <ul>
            <li>
              <NavLink 
                exact to="/" 
                activeClassName="selected">
                Home
              </NavLink>
            </li>
            <li>
              <NavLink 
                to="/characters" 
                activeClassName="selected">
                Characters
              </NavLink>
            </li>
            <li>
              <NavLink 
                to="/vehicles" 
                activeClassName="selected">
                Vehicles
              </NavLink>
            </li>
            <li>
              <NavLink 
                to="/lmalayers" 
                activeClassName="selected">
                LmaLayers
              </NavLink>
            </li>
            <li>
              <NavLink 
                to="/weather" 
                activeClassName="selected">
                Weather Types
              </NavLink>
            </li>
          </ul>
        </nav>
        <Suspense fallback={<div>Loading...</div>}>
          <Switch>
            <Route exact path="/" component={Home}></Route>
            <Route exact path="/characters" component={Characters}></Route>
            <Route exact path="/vehicles" component={Vehicles}></Route>
            <Route exact path="/lmalayers" component={Lmalayers}></Route>
            <Route exact path="/weather" component={Weather}></Route>
          </Switch>
        </Suspense>
      </Router>
      </div>
    </div>
  );
}

export default App;
