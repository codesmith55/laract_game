import React, { Component } from 'react';

/* Stateless component or pure component
 * { unit } syntax is the object destructing
 */

class Button extends React.Component {

	constructor(props) {
        super(props)

       	console.log(this.props.myFunction);
    }
	render() {
	    const buttonStyle = {
	        backgroundColor: 'green',
	        width: '100px',
	        height: "50px", 
	        color: 'black'
	    }
	    return(
	        <div style={buttonStyle} onClick={this.props.myFunction}>
		        	Button test 
		        </div>
		    )
    }

}
export default Button;