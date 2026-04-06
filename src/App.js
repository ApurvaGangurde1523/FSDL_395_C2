import React, { useState, useEffect } from "react";
import "./App.css";
import { evaluate } from "mathjs";

function App() {

  const [currentValue, setCurrentValue] = useState("0");
  const [expression, setExpression] = useState("");
  const [history, setHistory] = useState([]);
  const [scientificMode, setScientificMode] = useState(false);

  useEffect(() => {
    const savedHistory = JSON.parse(localStorage.getItem("history")) || [];
    setHistory(savedHistory);
  }, []);

  const updateHistory = (exp, res) => {
    const newHistory = [{ exp, res }, ...history];
    setHistory(newHistory);
    localStorage.setItem("history", JSON.stringify(newHistory));
  };

  const appendNumber = (num) => {
    if (currentValue === "0" && num !== ".") {
      setCurrentValue(num);
    } else if (num === "." && currentValue.includes(".")) {
      return;
    } else {
      setCurrentValue(currentValue + num);
    }
  };

  const appendOperator = (op) => {
    setExpression(expression + currentValue + " " + op + " ");
    setCurrentValue("");
  };

  const appendBracket = (b) => {
    if (currentValue !== "") {
      setExpression(expression + currentValue);
      setCurrentValue("");
    }
    setExpression((prev) => prev + b);
  };

  const factorial = (n) => {
  if (n < 0) return "Error";
  if (n === 0 || n === 1) return 1;

  let res = 1;
  for (let i = 2; i <= n; i++) {
    res *= i;
  }
  return res;
};

  const applyFunction = (func) => {
  let v = parseFloat(currentValue);

  if (isNaN(v) && func !== "pi" && func !== "e") return;

  let result = 0;

  switch (func) {
    case "sin":
      result = Math.sin(v * Math.PI / 180);
      break;

    case "cos":
      result = Math.cos(v * Math.PI / 180);
      break;

    case "tan":
      result = Math.tan(v * Math.PI / 180);
      break;

    case "log":
      result = Math.log10(v);
      break;

    case "ln":
      result = Math.log(v);
      break;

    case "sqrt":
      result = Math.sqrt(v);
      break;

    case "pow":
      result = Math.pow(v, 2);
      break;

    case "exp":
      result = Math.exp(v);
      break;

    case "pi":
      result = Math.PI;
      break;

    case "e":
      result = Math.E;
      break;

    case "abs":
      result = Math.abs(v);
      break;

    case "fact":
      result = factorial(Math.floor(v));
      break;

    default:
      return;
  }

  setCurrentValue(String(result));
};


const calculate = () => {
  try {

    let exp = expression + currentValue;

    exp = exp
      .replace(/π/g, "pi")
      .replace(/÷/g, "/")
      .replace(/×/g, "*");

    const result = evaluate(exp);

    updateHistory(exp, result);

    setCurrentValue(String(result));
    setExpression("");

  } catch {
    setCurrentValue("Error");
  }
};

  const clear = () => {
    setCurrentValue("0");
    setExpression("");
  };

  const clearHistory = () => {
    setHistory([]);
    localStorage.clear();
  };

  return (
    <div className="calculator-container">

      <div className="calculator-header">
        <h1>Calculator</h1>
      </div>

      <div className="mode-toggle">
        <button
          className={`mode-btn ${!scientificMode ? "active" : ""}`}
          onClick={() => setScientificMode(false)}
        >
          Basic
        </button>

        <button
          className={`mode-btn ${scientificMode ? "active" : ""}`}
          onClick={() => setScientificMode(true)}
        >
          Scientific
        </button>
      </div>

      <div className="display">
        <div className="expression">{expression}</div>
        <div className="current-value">{currentValue}</div>
      </div>

      {scientificMode && (
  <div className="scientific-buttons active">

    <button className="btn-scientific" onClick={() => applyFunction("sin")}>sin</button>
    <button className="btn-scientific" onClick={() => applyFunction("cos")}>cos</button>
    <button className="btn-scientific" onClick={() => applyFunction("tan")}>tan</button>
    <button className="btn-scientific" onClick={() => applyFunction("log")}>log</button>

    <button className="btn-scientific" onClick={() => applyFunction("ln")}>ln</button>
    <button className="btn-scientific" onClick={() => applyFunction("sqrt")}>√</button>
    <button className="btn-scientific" onClick={() => applyFunction("pow")}>x²</button>
    <button className="btn-scientific" onClick={() => applyFunction("exp")}>exp</button>

    <button className="btn-scientific" onClick={() => applyFunction("pi")}>π</button>
    <button className="btn-scientific" onClick={() => applyFunction("e")}>e</button>
    <button className="btn-scientific" onClick={() => applyFunction("abs")}>abs</button>
    <button className="btn-scientific" onClick={() => applyFunction("fact")}>n!</button>

  </div>
)}

      <div className="buttons">

        <button className="btn-function" onClick={clear}>AC</button>
        <button className="btn-bracket" onClick={() => appendBracket("(")}>(</button>
        <button className="btn-bracket" onClick={() => appendBracket(")")}> )</button>
        <button className="btn-operator" onClick={() => appendOperator("/")}>÷</button>

        <button className="btn-number" onClick={() => appendNumber("7")}>7</button>
        <button className="btn-number" onClick={() => appendNumber("8")}>8</button>
        <button className="btn-number" onClick={() => appendNumber("9")}>9</button>
        <button className="btn-operator" onClick={() => appendOperator("*")}>×</button>

        <button className="btn-number" onClick={() => appendNumber("4")}>4</button>
        <button className="btn-number" onClick={() => appendNumber("5")}>5</button>
        <button className="btn-number" onClick={() => appendNumber("6")}>6</button>
        <button className="btn-operator" onClick={() => appendOperator("-")}>−</button>

        <button className="btn-number" onClick={() => appendNumber("1")}>1</button>
        <button className="btn-number" onClick={() => appendNumber("2")}>2</button>
        <button className="btn-number" onClick={() => appendNumber("3")}>3</button>
        <button className="btn-operator" onClick={() => appendOperator("+")}>+</button>

        <button className="btn-number btn-zero" onClick={() => appendNumber("0")}>0</button>
        <button className="btn-number" onClick={() => appendNumber(".")}>.</button>
        <button className="btn-equals" onClick={calculate}>=</button>

      </div>

      <div className="history-panel">

        <div className="history-header">
          <span className="history-title">History</span>
          <button className="clear-history" onClick={clearHistory}>Clear</button>
        </div>

        {history.length === 0 ? (
          <div className="empty-history">No history</div>
        ) : (
          history.map((h, i) => (
            <div key={i} className="history-item">
              <div className="history-expression">{h.exp}</div>
              <div className="history-result">{h.res}</div>
            </div>
          ))
        )}

      </div>

    </div>
  );
}

export default App;