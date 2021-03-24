import {
  BrowserRouter as Router,
  Switch,
  Route,
  NavLink
} from 'react-router-dom';
import './styles/App.css';

import Home from './components/home';
import Vehicles from './components/vehicles';
import Characters from './components/characters';
import Lmalayers from './components/lmalayers';
import Weather from './components/weather';

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
        <Switch>
          <Route exact path="/" component={Home}></Route>
          <Route exact path="/characters" component={Characters}></Route>
          <Route exact path="/vehicles" component={Vehicles}></Route>
          <Route exact path="/lmalayers" component={Lmalayers}></Route>
          <Route exact path="/weather" component={Weather}></Route>
        </Switch>
      </Router>
      </div>
    </div>
  );
}

export default App;
