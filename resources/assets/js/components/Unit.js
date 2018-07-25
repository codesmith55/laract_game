import React, { Component } from 'react';

/* Stateless component or pure component
 * { unit } syntax is the object destructing
 */
const Unit = ({unit}) => {

    const divStyle = {
        display: 'flex',
        flexDirection: 'column',
        width: '65%',
        margin: '30px 10px 10px 30px'
    }

    //if the props for unit is null, return Unit doesn't exist
    if(!unit) {

        return(<div style={divStyle}><h2>  No Unit was selected </h2> </div>);
    }
    //Else, display the unit data
    return(
        <div style={divStyle} class="unitSelectedable">
            <h2> {unit.name} </h2>
            <p> {unit.level} </p>
            <h3> Stats 2 </h3>
            <ul>
                <li>Evocation: {unit.stat_evocation}</li>
                <li>Abjuration: {unit.stat_abjuration}</li>
                <li>Divination: {unit.stat_divination}</li>
                <li>Transmutation: {unit.stat_transmutation}</li>
                <li>Symbiosis: {unit.stat_symbiosis}</li>
                <li>convert_evocation: {unit.convert_evocation}</li>
                <li>convert_abjuration: {unit.convert_abjuration}</li>
                <li>convert_divination: {unit.convert_divination}</li>
                <li>convert_transmutation: {unit.convert_transmutation}</li>
                <li>convert_symbiosis: {unit.convert_symbiosis}</li>
            </ul>
        </div>
    )
}

export default Unit ;