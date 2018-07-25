import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Unit from './Unit';
import AddUnit from './AddUnit';
import DisplayUnit from './DisplayUnit';
import GameTurn from './GameTurn';
import StartGame from './StartGame';
import Button from './Button';

/* Home Component */
class Home extends Component {

    constructor() {

        super();
        //Initialize the state in the constructor
        this.state = {
            units: [],
            currentUnit: null
        }
        this.handleUnitClick = this.handleUnitClick.bind(this);
    }
    /*componentDidMount() is a lifecycle method
     * that gets called after the component is rendered
     */
    componentDidMount() {
        /* fetch API in action */
        fetch('/api/units')
            .then(response => {
                console.log(response);
                return response.json();
            })
            .then(units => {
                //Fetched unit is stored in the state

                if (this.refs.myRef)
                    this.setState({ units });
            });
    }

    renderUnits() {
        return this.state.units.map(unit => {
            return (
                /* When using list you need to specify a key
                 * attribute that is unique for each list item
                */
                <li onClick={
                    () =>this.handleUnitClick(unit)} key={unit.id} >
                    {unit.id} : { unit.name }
                </li>
            );
        })
    }

    handleUnitClick(unit) {

        //handleUnitClick is used to set the state
        this.setState({currentUnit:unit});

    }
    changeState() {
        this.props.parentFunction();
    }
/*    render() {

        if (this.state.home) {
            return this.renderLoading();
        } else if (this.state.planet) {
            return this.renderPlanet();
        } else {
            return this.renderError();
        }
    }*/

    render() {
        return (
            <div ref="myRef">
                {/* The button will execute the handler function set by the parent component */}
                ChangeState Button<Button myFunction={this.props.parentFunction} />
                <div className="mainDivStyle">
                    <div className="divStyle">
                        <h3> All the Units </h3>
                        <ul>
                            { this.renderUnits() }
                        </ul>

                    </div>
                    <Unit unit={this.state.currentUnit} />
                </div>

            </div>

        );
    }

}

export default Home;

/* The if statement is required so as to Render the component
 * on pages that have a div with an ID of "root";
 */

if (document.getElementById('root')) {
    ReactDOM.render(<Home />, document.getElementById('root'));
}