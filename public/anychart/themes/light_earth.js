/**
 * AnyChart is lightweight robust charting library with great API and Docs, that works with your stack and has tons of chart types and features.
 *
 * Theme: lightEarth
 * Version: 2.0.0 (2019-04-26)
 * License: https://www.anychart.com/buy/
 * Contact: sales@anychart.com
 * Copyright: AnyChart.com 2019. All rights reserved.
 */
(function() {
  "use strict";

  function a() {
    return window.anychart.color.setOpacity(this.sourceColor, 0.6, !0);
  }
  function b() {
    return window.anychart.color.darken(this.sourceColor);
  }
  function c() {
    return window.anychart.color.lighten(this.sourceColor);
  }
  var e = {
    palette: {
      type: "distinct",
      items: "#827717 #c77532 #998675 #6b617b #c69c6d #d29b9b #879872 #16685d #57a7b1 #bdbdbd".split(
        " "
      )
    },
    defaultOrdinalColorScale: {
      autoColors: function(d) {
        return window.anychart.color.blendedHueProgression(
          "#827717",
          "#c77532",
          d
        );
      }
    },
    defaultLinearColorScale: { colors: ["#827717", "#c77532"] },
    defaultFontSettings: { fontColor: "#757575" },
    defaultBackground: {
      fill: "#f7f3f3",
      stroke: "#bdbdbd",
      cornerType: "round",
      corners: 0
    },
    defaultAxis: {
      stroke: "#9e9e9e 0.4",
      ticks: { stroke: "#9e9e9e 0.4" },
      minorTicks: { stroke: "#bdbdbd 0.4" }
    },
    defaultGridSettings: { stroke: "#9e9e9e 0.4" },
    defaultMinorGridSettings: { stroke: "#bdbdbd 0.4" },
    defaultSeparator: { fill: "#bdbdbd 0.6" },
    defaultTooltip: {
      background: { stroke: "1.5 #bdbdbd", corners: 5 },
      padding: { top: 8, right: 15, bottom: 10, left: 15 }
    },
    defaultColorRange: {
      stroke: "#b0bec5",
      ticks: { stroke: "#b0bec5", position: "outside", length: 7, enabled: !0 },
      minorTicks: {
        stroke: "#b0bec5",
        position: "outside",
        length: 5,
        enabled: !0
      },
      marker: {
        padding: { top: 3, right: 3, bottom: 3, left: 3 },
        fill: "#b0bec5"
      }
    },
    defaultScroller: {
      fill: "#efe9e9",
      selectedFill: "#bdbdbd",
      thumbs: {
        fill: "#e9e4e4",
        stroke: "#bdbdbd",
        hovered: { fill: "#fff", stroke: "#e9e4e4" }
      }
    },
    chart: {
      defaultSeriesSettings: {
        base: {
          hovered: { fill: "#bdbdbd" },
          selected: {
            fill: "#616161",
            stroke: "1.5 #424242",
            markers: { stroke: "1.5 #616161" }
          }
        },
        candlestick: {
          normal: {
            risingFill: "#827717",
            risingStroke: "#827717",
            fallingFill: "#c77532",
            fallingStroke: "#c77532"
          },
          hovered: {
            risingFill: c,
            risingStroke: b,
            fallingFill: c,
            fallingStroke: b
          },
          selected: {
            risingStroke: "3 #827717",
            fallingStroke: "3 #c77532",
            risingFill: "#333333 0.85",
            fallingFill: "#333333 0.85"
          }
        },
        ohlc: {
          normal: { risingStroke: "#827717", fallingStroke: "#c77532" },
          hovered: { risingStroke: b, fallingStroke: b },
          selected: { risingStroke: "3 #827717", fallingStroke: "3 #c77532" }
        }
      },
      padding: { top: 20, right: 25, bottom: 15, left: 15 }
    },
    pieFunnelPyramidBase: {
      normal: { labels: { fontColor: null } },
      connectorStroke: "#bdbdbd",
      outsideLabels: { autoColor: "#888888" },
      insideLabels: { autoColor: "#212121" }
    },
    map: {
      unboundRegions: { enabled: !0, fill: "#e9e4e4", stroke: "#bdbdbd" },
      defaultSeriesSettings: {
        base: {
          normal: { stroke: b, labels: { fontColor: "#212121" } },
          hovered: { fill: "#bdbdbd" },
          selected: { fill: "#616161", stroke: "1.5 #424242" }
        },
        connector: {
          normal: { markers: { stroke: "1.5 #e9e4e4" } },
          hovered: { markers: { stroke: "1.5 #e9e4e4" } },
          selected: {
            stroke: "1.5 #212121",
            markers: { fill: "#212121", stroke: "1.5 #e9e4e4" }
          }
        }
      }
    },
    sparkline: {
      padding: 0,
      background: { stroke: "#f7f3f3" },
      defaultSeriesSettings: {
        area: { stroke: "1.5 #827717", fill: "#827717 0.5" },
        column: { fill: "#827717", negativeFill: "#c77532" },
        line: { stroke: "1.5 #827717" },
        winLoss: { fill: "#827717", negativeFill: "#c77532" }
      }
    },
    bullet: {
      background: { stroke: "#f7f3f3" },
      defaultMarkerSettings: { fill: "#827717", stroke: "2 #827717" },
      padding: { top: 5, right: 10, bottom: 5, left: 10 },
      margin: { top: 0, right: 0, bottom: 0, left: 0 },
      rangePalette: {
        items: ["#ABABAB", "#B9B8B8", "#CAC8C8", "#DCDADA", "#EAE6E6"]
      }
    },
    heatMap: {
      normal: { stroke: "1 #f7f3f3", labels: { fontColor: "#212121" } },
      hovered: { stroke: "1.5 #f7f3f3" },
      selected: { stroke: "2 #f7f3f3" }
    },
    treeMap: {
      normal: {
        headers: {
          background: { enabled: !0, fill: "#e9e4e4", stroke: "#bdbdbd" }
        },
        labels: { fontColor: "#212121" },
        stroke: "#bdbdbd"
      },
      hovered: {
        headers: {
          fontColor: "#757575",
          background: { fill: "#bdbdbd", stroke: "#bdbdbd" }
        }
      },
      selected: { labels: { fontColor: "#fafafa" }, stroke: "2 #eceff1" }
    },
    stock: {
      padding: [20, 30, 20, 60],
      defaultPlotSettings: {
        xAxis: { background: { fill: "#e9e4e4 0.6", stroke: "#9e9e9e 0.6" } }
      },
      scroller: {
        fill: "none",
        selectedFill: "#e9e4e4 0.6",
        outlineStroke: "#9e9e9e 0.6",
        defaultSeriesSettings: {
          base: { selected: { fill: a, stroke: a } },
          candlestick: {
            normal: {
              risingFill: "#999 0.6",
              risingStroke: "#999 0.6",
              fallingFill: "#999 0.6",
              fallingStroke: "#999 0.6"
            },
            selected: {
              risingStroke: a,
              fallingStroke: a,
              risingFill: a,
              fallingFill: a
            }
          },
          ohlc: {
            normal: { risingStroke: "#999 0.6", fallingStroke: "#999 0.6" },
            selected: { risingStroke: a, fallingStroke: a }
          }
        }
      }
    }
  };
  window.anychart = window.anychart || {};
  window.anychart.themes = window.anychart.themes || {};
  window.anychart.themes.lightEarth = e;
})();
