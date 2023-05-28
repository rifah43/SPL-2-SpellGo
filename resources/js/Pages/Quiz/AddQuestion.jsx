import React, { useState } from "react";
import axios from "axios";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";

function AddQuestion() {
  const [options, setOptions] = useState([
    { index: 0, isCorrect: true, value: "" },
    { index: 1, isCorrect: false, value: "" },
  ]);

  const handleSubmit = async (event) => {
    event.preventDefault();
    const correctIndex = options.findIndex((option) => option.isCorrect === true);
    const formData = {
      question: event.target.question.value,
      correct_answer_index: correctIndex,
      answer: options.map((option) => option.value),
    };
    try {
      const response = await axios.post('/add', formData);
      console.log(response.data);
      if (response.data.success) {
        location.reload();
      } else {
        location.reload();
      }
    } catch (error) {
      console.error(error);
    }
  };
  
  const handleAddOption = () => {
    if (options.length >= 5) {
      alert("Maximum five options can be added!");
      return;
    }
    setOptions([
      ...options,
      { index: options.length, isCorrect: false, value: "" },
    ]);
  };

  const handleRemoveOption = (index) => {
    if (options.length <= 2) {
      alert("Minimum two options should be present!");
      return;
    }
    setOptions(options.filter((o) => o.index !== index));
  };

  const handleSelectOption = (index) => {
    setOptions(
      options.map((o) => ({
        ...o,
        isCorrect: o.index === index,
      }))
    );
  };

  return (
    <div className="container-fluid w-100">
      <div className="header">
        <h1 className="title" id="exampleLabel">
          Add Question
        </h1>
        <a href="/add-question" className="btn btn-link">Return</a>
      </div>
      <div className="row">
        <div className="col-md-12">
          <form onSubmit={handleSubmit}>
            <div className="form-group">
              <label htmlFor="question">Question:</label>
              <textarea
                className="form-control"
                id="question"
                name="question"
                required
              ></textarea>
            </div>
            <div className="form-group">
              <label>Options:</label>
              {options && Array.isArray(options) && options.map && options.map((option) => (
                <div key={option.index} className="input-group my-2">
                  <div className="input-group-prepend">
                    <div className="input-group-text">
                      <input
                        type="radio"
                        name="correct_answer"
                        value={option.index}
                        onChange={() => handleSelectOption(option.index)}
                        checked={option.isCorrect}
                      />
                    </div>
                  </div>
                  <input
                    type="text"
                    className="form-control"
                    placeholder={`Option ${option.index + 1}`}
                    value={option.value}
                    onChange={(event) =>
                      setOptions(
                        options.map((o) =>
                          o.index === option.index
                            ? { ...o, value: event.target.value }
                            : o
                        )
                      )
                    }
                    required
                  />
                  <div className="input-group-append">
                    <button
                    className="btn btn-danger"
                    type="button"
                    onClick={() => handleRemoveOption(option.index)}
                    >
                    Remove
                    </button>
                  </div>
                </div>
              ))}
              <button
                className="btn btn-success my-2"
                type="button"
                onClick={handleAddOption}
              >
              Add Option
              </button>
              <button className="btn btn-primary float-right" type="submit">
              Submit
            </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}

export default AddQuestion;