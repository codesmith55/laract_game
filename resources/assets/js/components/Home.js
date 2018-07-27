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
            heroes: [],
            monsters: [],
            currentUnit: null,
            currentMonster: null
        }
        this.handleUnitClick = this.handleUnitClick.bind(this);
    }
    /*componentDidMount() is a lifecycle method
     * that gets called after the component is rendered
     */
    componentDidMount() {
        /* fetch API in action */
        fetch('/api/heroes')
            .then(response => {
                console.log(response);
                return response.json();
            })
            .then(heroes => {
                //Fetched unit is stored in the state

                if (this.refs.myRef)//what is this line for?
                    this.setState({ heroes });
            });
        fetch('/api/monsters')
            .then(response => {
                console.log(response);
                return response.json();
            })
            .then(monsters => {
                //Fetched unit is stored in the state

                if (this.refs.myRef)
                    this.setState({ monsters });
            });
    }

    renderHeroes() {
        return this.state.heroes.map(unit => {
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
    renderMonsters() {
        console.log(typeof (this.state.monsters));

        return this.state.monsters ? this.state.monsters.map(monster => {
            return (
                /* When using list you need to specify a key
                 * attribute that is unique for each list item
                */
                <li onClick={
                    () =>this.handleUnitClick(monster)} key={monster.id} >
                    {monster.id} : { monster.name }
                </li>
            );
        }) : "loading...";
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

                <div className="monsterDiv">
                    {this.state.monsters ?
                        <span>{ this.renderMonsters() }</span> :
                        <span>Loading...</span>
                    }

                </div>

                ChangeState Button<Button myFunction={this.props.parentFunction} />
                <div className="mainDivStyle">
                    <div className="divStyle">
                        <h3> All the Heroes </h3>
                        <ul>
                            { this.renderHeroes() }
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