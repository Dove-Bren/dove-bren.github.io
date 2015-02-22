function init() {
    
    var json = (function () {
    var json = null;
    $.ajax({
        'async': false,
        'global': false,
        'url': "./data/ExtendTree.json",
        'dataType': "json",
        'success': function (data) {
            json = data;
        }
    });
    return json;
    })();
    //var json = require('./data/ExtendTree.json');//= { "id": "java.lang.Object", "name": "Object", "data": {"package": "java.lang"}, "children": [{ "id": "com.smanzana.Exploratory2.Representations.Method", "name": "Method", "data": {"package": "com.smanzana.Exploratory2.Representations"}, "children": []} , { "id": "com.smanzana.Exploratory2.Graph.DirectedGraphNode", "name": "DirectedGraphNode", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": [{ "id": "com.smanzana.Exploratory2.Graph.DirectedGraphNode", "name": "DirectedGraphNode", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": []}]} , { "id": "com.smanzana.Exploratory2.Representations.Cclass", "name": "Cclass", "data": {"package": "com.smanzana.Exploratory2.Representations"}, "children": []} , { "id": "com.smanzana.Exploratory2.Driver", "name": "Driver", "data": {"package": "com.smanzana.Exploratory2"}, "children": []} , { "id": "com.smanzana.Exploratory2.FileParsing.FileParser", "name": "FileParser", "data": {"package": "com.smanzana.Exploratory2.FileParsing"}, "children": []} , { "id": "com.smanzana.Exploratory2.Tree.Tree", "name": "Tree", "data": {"package": "com.smanzana.Exploratory2.Tree"}, "children": []} , { "id": "com.smanzana.Exploratory2.Representations.Import", "name": "Import", "data": {"package": "com.smanzana.Exploratory2.Representations"}, "children": []} , { "id": "com.smanzana.Exploratory2.Util.Pair<a,b>", "name": "Pair<a,b>", "data": {"package": "com.smanzana.Exploratory2.Util"}, "children": []} , { "id": "com.smanzana.Exploratory2.Graph.UndirectedWeightedEdge", "name": "UndirectedWeightedEdge", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": []} , { "id": "com.smanzana.Exploratory2.Tree.wowInterface", "name": "wowInterface", "data": {"package": "com.smanzana.Exploratory2.Tree"}, "children": [{ "id": "com.smanzana.Exploratory2.Tree.wowInterface", "name": "wowInterface", "data": {"package": "com.smanzana.Exploratory2.Tree"}, "children": [{ "id": "com.smanzana.Exploratory2.Tree.Wow", "name": "Wow", "data": {"package": "com.smanzana.Exploratory2.Tree"}, "children": []}]}]} , { "id": "com.smanzana.Exploratory2.FileParsing.ClassDeclaration", "name": "ClassDeclaration", "data": {"package": "com.smanzana.Exploratory2.FileParsing"}, "children": []} , { "id": "com.smanzana.Exploratory2.Graph.GraphNode", "name": "GraphNode", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": []} , { "id": "com.smanzana.Exploratory2.FileParsing.JSON", "name": "JSON", "data": {"package": "com.smanzana.Exploratory2.FileParsing"}, "children": []} , { "id": "com.smanzana.Exploratory2.Graph.Graph", "name": "Graph", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": [{ "id": "com.smanzana.Exploratory2.Graph.UndirectedGraph", "name": "UndirectedGraph", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": []} , { "id": "com.smanzana.Exploratory2.Graph.DirectedGraph", "name": "DirectedGraph", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": []}]} , { "id": "com.smanzana.Exploratory2.Graph.DirectedWeightedEdge", "name": "DirectedWeightedEdge", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": [{ "id": "com.smanzana.Exploratory2.Graph.DirectedWeightedEdge", "name": "DirectedWeightedEdge", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": []}]}]};
 //   require(['./data/ExtendTree.json'], function(json) {
 //       //nothing?
 //   });
//    $.getJSON("./data/ExtendTree.json", function(file) {
//        json = file;
//    });
    
    var st = new $jit.ST({
        injectInto: 'infovis',
        type: '2D',
        width: 700,
        height: 700,
        
        Navigation: {
          enable:true,
          panning:true
        },
                
        Node: {
            width: 200,
            autoWidth: true,
            autoHeight: true,
            overridable: true,
            align: 'left'
        },
        
//        onBeforePlotNode: function(node) {
//            node.width = (node.name.length * 20) + 'px';
//            node.setCanvasStyle('width', (node.name.length * 10) + 'px');
//        },
        
        onCreateLabel: function(label, node){
            label.id = node.id;            
            label.innerHTML = ' ' + node.name;
            label.onclick = function(){
            	if(normal.checked) {
            	  st.onClick(node.id);
            	} else {
                st.setRoot(node.id, 'animate');
            	}
            };
            //set label styles
            var style = label.style;
            style.width = (node.name.length * 10);
            style.height = 17 + 'px';            
            style.cursor = 'pointer';
            style.color = '#333';
            style.fontSize = '10pt';
            style.textAlign= 'left';
            style.paddingTop = '3px';
            style.paddingLeft = '2px';
            //style.paddingRight = '5px';
        }
    });
    
    //load json data
    st.loadJSON(json);
    //compute node positions and layout
    st.compute();
    //optional: make a translation of the tree
    //st.geom.translate(new $jit.Complex(-200, 0), "current");
    //emulate a click on the root node.
    st.onClick(st.root);
}



/*
var labelType, useGradients, nativeTextSupport, animate;

(function() {
  var ua = navigator.userAgent,
      iStuff = ua.match(/iPhone/i) || ua.match(/iPad/i),
      typeOfCanvas = typeof HTMLCanvasElement,
      nativeCanvasSupport = (typeOfCanvas == 'object' || typeOfCanvas == 'function'),
      textSupport = nativeCanvasSupport 
        && (typeof document.createElement('canvas').getContext('2d').fillText == 'function');
  //I'm setting this based on the fact that ExCanvas provides text support for IE
  //and that as of today iPhone/iPad current text support is lame
  labelType = (!nativeCanvasSupport || (textSupport && !iStuff))? 'Native' : 'HTML';
  nativeTextSupport = labelType == 'Native';
  useGradients = nativeCanvasSupport;
  animate = !(iStuff || !nativeCanvasSupport);
})();

//var Log = {
//  elem: false,
//  write: function(text){
//    if (!this.elem) 
//      this.elem = document.getElementById('log');
//    this.elem.innerHTML = text;
//    this.elem.style.left = (500 - this.elem.offsetWidth / 2) + 'px';
//  }
//};


function init(){

    //init data
    var json = { "id": "java.lang.Object", "name": "Object", "data": {"package": "java.lang"}, "children": [{ "id": "com.smanzana.Exploratory2.Representations.Method", "name": "Method", "data": {"package": "com.smanzana.Exploratory2.Representations"}, "children": []} , { "id": "com.smanzana.Exploratory2.Graph.DirectedGraphNode", "name": "DirectedGraphNode", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": [{ "id": "com.smanzana.Exploratory2.Graph.DirectedGraphNode", "name": "DirectedGraphNode", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": []}]} , { "id": "com.smanzana.Exploratory2.Representations.Cclass", "name": "Cclass", "data": {"package": "com.smanzana.Exploratory2.Representations"}, "children": []} , { "id": "com.smanzana.Exploratory2.Driver", "name": "Driver", "data": {"package": "com.smanzana.Exploratory2"}, "children": []} , { "id": "com.smanzana.Exploratory2.FileParsing.FileParser", "name": "FileParser", "data": {"package": "com.smanzana.Exploratory2.FileParsing"}, "children": []} , { "id": "com.smanzana.Exploratory2.Tree.Tree", "name": "Tree", "data": {"package": "com.smanzana.Exploratory2.Tree"}, "children": []} , { "id": "com.smanzana.Exploratory2.Representations.Import", "name": "Import", "data": {"package": "com.smanzana.Exploratory2.Representations"}, "children": []} , { "id": "com.smanzana.Exploratory2.Util.Pair<a,b>", "name": "Pair<a,b>", "data": {"package": "com.smanzana.Exploratory2.Util"}, "children": []} , { "id": "com.smanzana.Exploratory2.Graph.UndirectedWeightedEdge", "name": "UndirectedWeightedEdge", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": []} , { "id": "com.smanzana.Exploratory2.Tree.wowInterface", "name": "wowInterface", "data": {"package": "com.smanzana.Exploratory2.Tree"}, "children": [{ "id": "com.smanzana.Exploratory2.Tree.wowInterface", "name": "wowInterface", "data": {"package": "com.smanzana.Exploratory2.Tree"}, "children": [{ "id": "com.smanzana.Exploratory2.Tree.Wow", "name": "Wow", "data": {"package": "com.smanzana.Exploratory2.Tree"}, "children": []}]}]} , { "id": "com.smanzana.Exploratory2.FileParsing.ClassDeclaration", "name": "ClassDeclaration", "data": {"package": "com.smanzana.Exploratory2.FileParsing"}, "children": []} , { "id": "com.smanzana.Exploratory2.Graph.GraphNode", "name": "GraphNode", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": []} , { "id": "com.smanzana.Exploratory2.FileParsing.JSON", "name": "JSON", "data": {"package": "com.smanzana.Exploratory2.FileParsing"}, "children": []} , { "id": "com.smanzana.Exploratory2.Graph.Graph", "name": "Graph", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": [{ "id": "com.smanzana.Exploratory2.Graph.UndirectedGraph", "name": "UndirectedGraph", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": []} , { "id": "com.smanzana.Exploratory2.Graph.DirectedGraph", "name": "DirectedGraph", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": []}]} , { "id": "com.smanzana.Exploratory2.Graph.DirectedWeightedEdge", "name": "DirectedWeightedEdge", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": [{ "id": "com.smanzana.Exploratory2.Graph.DirectedWeightedEdge", "name": "DirectedWeightedEdge", "data": {"package": "com.smanzana.Exploratory2.Graph"}, "children": []}]}]};
    //end
    //init Spacetree
    //Create a new ST instance
    var st = new $jit.ST({
        //id of viz container element
        injectInto: 'infovis',
        //set duration for the animation
        duration: 800,
        //set animation transition type
        transition: $jit.Trans.Quart.easeInOut,
        //set distance between node and its children
        levelDistance: 50,
        //enable panning
        Navigation: {
          enable:true,
          panning:true
        },
        //set node and edge styles
        //set overridable=true for styling individual
        //nodes or edges
        Node: {
            height: 20,
            width: 60,
            type: 'rectangle',
            color: '#aaa',
            overridable: true
        },
        
        Edge: {
            type: 'bezier',
            overridable: true
        },
        
        onBeforeCompute: function(node){
            //Log.write("loading " + node.name);
        },
        
        onAfterCompute: function(){
            //Log.write("done");
        },
        
        //This method is called on DOM label creation.
        //Use this method to add event handlers and styles to
        //your node.
        onCreateLabel: function(label, node){
            label.id = node.id;            
            label.innerHTML = node.name;
            label.onclick = function(){
            	if(normal.checked) {
            	  st.onClick(node.id);
            	} else {
                st.setRoot(node.id, 'animate');
            	}
            };
            //set label styles
            var style = label.style;
            style.width = 60 + 'px';
            style.height = 17 + 'px';            
            style.cursor = 'pointer';
            style.color = '#333';
            style.fontSize = '0.8em';
            style.textAlign= 'center';
            style.paddingTop = '3px';
        },
        
        //This method is called right before plotting
        //a node. It's useful for changing an individual node
        //style properties before plotting it.
        //The data properties prefixed with a dollar
        //sign will override the global node style properties.
        onBeforePlotNode: function(node){
            //add some color to the nodes in the path between the
            //root node and the selected node.
            if (node.selected) {
                node.data.$color = "#ff7";
            }
            else {
                delete node.data.$color;
                //if the node belongs to the last plotted level
                if(!node.anySubnode("exist")) {
                    //count children number
                    var count = 0;
                    node.eachSubnode(function(n) { count++; });
                    //assign a node color based on
                    //how many children it has
                    node.data.$color = ['#aaa', '#baa', '#caa', '#daa', '#eaa', '#faa'][count];                    
                }
            }
        },
        
        //This method is called right before plotting
        //an edge. It's useful for changing an individual edge
        //style properties before plotting it.
        //Edge data proprties prefixed with a dollar sign will
        //override the Edge global style properties.
        onBeforePlotLine: function(adj){
            if (adj.nodeFrom.selected && adj.nodeTo.selected) {
                adj.data.$color = "#eed";
                adj.data.$lineWidth = 3;
            }
            else {
                delete adj.data.$color;
                delete adj.data.$lineWidth;
            }
        }
    });
    //load json data
    st.loadJSON(json);
    //compute node positions and layout
    st.compute();
    //optional: make a translation of the tree
    st.geom.translate(new $jit.Complex(-200, 0), "current");
    //emulate a click on the root node.
    st.onClick(st.root);
    //end
    //Add event handlers to switch spacetree orientation.
    //var top = $jit.id('r-top'), 
    //    left = $jit.id('r-left'), 
    //    bottom = $jit.id('r-bottom'), 
    //    right = $jit.id('r-right'),
    //    normal = $jit.id('s-normal');
        
    
//    function changeHandler() {
//        if(this.checked) {
//            top.disabled = bottom.disabled = right.disabled = left.disabled = true;
//            st.switchPosition(this.value, "animate", {
//                onComplete: function(){
//                    top.disabled = bottom.disabled = right.disabled = left.disabled = false;
//                }
//            });
//        }
//    };
    
    //top.onchange = left.onchange = bottom.onchange = right.onchange = changeHandler;
    //end

}
*/