import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Home from './Home';


/* Main Component */
class Main extends Component {

    constructor() {

        super();
        //Initialize the state in the constructor
        this.state = {
            products: [],
            currentProduct: null,
            screen: "home",
            parent: null,
        }
        this.changeMyState = this.changeMyState.bind(this);
    }
    /*componentDidMount() is a lifecycle method
     * that gets called after the component is rendered
     */
    componentDidMount() {
        /* fetch API in action
        fetch('/api/products')
            .then(response => {
                return response.json();
            })
            .then(products => {
                //Fetched product is stored in the state
                this.setState({ products });
            });*/
    }

    changeMyState()
    {
        this.setState({
            screen: "battle",
        });
    }


    render() {
        if (this.state.screen == "home") {
            return <Home parentFunction={this.changeMyState}/>

        } else if (this.state.screen == "battle") {
            return (
                <div>
                    Battle div element to go here
                </div>
            )
        } else if (this.state.planet) {
            return this.renderPlanet();
        } else {
            return this.renderError();
        }
    }

}

export default Main;

/* The if statement is required so as to Render the component
 * on pages that have a div with an ID of "root";
 */

if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
}