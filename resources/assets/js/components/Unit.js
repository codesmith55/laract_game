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
    var converts_evo_array = JSON.parse('[["convert","evocation","Defense",1],["convert","evocation","Attack",1]]').map(function(item, i){
        return <li key={i}>{item[2]} {item[3]}</li>
    });

    this.parseAugments = function(augmentsString){
        if(augmentsString == null || (augmentsString).trim() == "")
            return "";

        return JSON.parse(augmentsString).map(function(item, i){
            return <li key={i}>{item[2]} {item[3]}</li>
        });
    }
    this.displayConvert_evocation = this.parseAugments(unit.convert_evocation);
    this.displayConvert_abjuration = this.parseAugments(unit.convert_abjuration);
    this.displayConvert_divination = this.parseAugments(unit.convert_divination);
    this.displayConvert_transmutation = this.parseAugments(unit.convert_transmutation);
    this.displayConvert_symbiosis = this.parseAugments(unit.convert_symbiosis);




    //var evo_convert = conv
    //Else, display the unit data
    return(
        <div style={divStyle} className="unitSelectedable">
            <h2> {unit.name} </h2>
            <p> {unit.level} </p>
            <h3> Stats 2 </h3>
            <ul>
                <li>Evocation: {unit.stat_evocation}</li>
                <li>Abjuration: {unit.stat_abjuration}</li>
                <li>Divination: {unit.stat_divination}</li>
                <li>Transmutation: {unit.stat_transmutation}</li>
                <li>Symbiosis: {unit.stat_symbiosis}</li>
                <li>convert_evocation: <ul>{this.displayConvert_evocation}</ul></li>
                <li>convert_abjuration: <ul>{this.displayConvert_abjuration}</ul></li>
                <li>convert_divination: <ul>{this.displayConvert_divination}</ul></li>
                <li>convert_transmutation: <ul>{this.displayConvert_transmutation}</ul></li>
                <li>convert_symbiosis: <ul>{this.displayConvert_symbiosis}</ul></li>
            </ul>
        </div>
    )

}

export default Unit ;