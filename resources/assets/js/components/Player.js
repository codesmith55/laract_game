import React, { Component } from 'react';

/* Stateless component or pure component
 * { player } syntax is the object destructing
 */
const Player = ({player}) => {

    const divStyle = {
        display: 'flex',
        flexDirection: 'column',
        width: '65%',
        margin: '30px 10px 10px 30px'
    }

    //if the props for player is null, return Player doesn't exist
    if(!player) {

        return(<div style={divStyle}><h2>  No Player was selected </h2> </div>);
    }

    //Else, display the player data
    return(
        <div style={divStyle}>
            <h2> {player.name} </h2>
            <p> {player.level} </p>
            <h3> Status {player.status} </h3>
        </div>
    )
}

export default Player ;