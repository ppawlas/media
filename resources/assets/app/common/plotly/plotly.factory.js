import PlotlyCore from "plotly.js/lib/core";

class Plotly {
    static factory() {
        PlotlyCore.register([
            require("plotly.js/lib/bar"),
        ]);
        return PlotlyCore;
    }
}

export default Plotly;