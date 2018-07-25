export default class Default extends React.Component {
    // State:
    // { loading: true }
    // { loading: false, planet: { name, climate, terrain } }
    // { loading: false, error: any }
    state = { loading: true };

    componentDidMount() {
        fetch("/api/test")
            .then(res => res.json())
            .then(
                planet => this.setState({ loading: false, planet }),
                error => this.setState({ loading: false, error })
            );
    }

    renderLoading() {
        return <div>Loading...</div>;
    }

    renderError() {
        return <div>I'm sorry! Please try again.</div>;
    }

    renderPlanet() {
        const { name, climate, terrain } = this.state.planet;
        return (
            <div>
                <h2>{name}</h2>
                <div>Climate: {climate}</div>
                <div>Terrain: {terrain}</div>
            </div>
        );
    }

    render() {
        if (this.state.loading) {
            return this.renderLoading();
        } else if (this.state.planet) {
            return this.renderPlanet();
        } else {
            return this.renderError();
        }
    }
}