import React, { Component } from 'react';

class GameTurn extends Component {

    constructor(props) {
        super(props);
        /* Initialize the state. */
        this.state = {
            GameTurn: {
                TurnNumber:"",
            }
        }

        //Boilerplate code for binding methods with `this`
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleInput = this.handleInput.bind(this);
    }

    /* This method dynamically accepts inputs and stores it in the state */
    handleInput(key, e) {

        /*Duplicating and updating the state */
        var state = Object.assign({}, this.state.newPlayer);
        state[key] = e.target.value;
        this.setState({newPlayer: state });
    }
    /* This method is invoked when submit button is pressed */
    handleSubmit(e) {
        //preventDefault prevents page reload   
        e.preventDefault();
        /*A call back to the onAdd props. The control is handed over
         *to the parent component. The current state is passed 
         *as a param
         */
        this.props.onAdd(this.state.newPlayer);
    }

    render() {
        return(
            <div>
                <div style="">
                    <form onSubmit={this.handleSubmit}>

                        <input type="submit" value="New Turn" />
                    </form>
                </div>
            </div>)
    }
}

export default GameTurn;
  