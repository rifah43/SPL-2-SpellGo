import React, { useState, useEffect } from 'react';
import { Inertia } from '@inertiajs/inertia';

const Questions = () => {
  const [questions, setQuestions] = useState([]);

  useEffect(() => {
    fetch('/add-question')
      .then(response => response.json())
      .then(data => setQuestions(data))
      .catch(error => console.log(error));

      console.log(response);
  }, []);

  const deleteQuestion = id => {
    fetch(`/add-question/${id}`, { method: 'DELETE' })
      .then(response => {
        if (response.ok) {
          setQuestions(questions.filter(q => q.id !== id));
        } else {
          console.log('Failed to delete question');
        }
      })
      .catch(error => console.log(error));
  };

  return (
    <div className="container-xl">
      <div className="table-responsive">
        <div className="table-wrapper">
          <div className="table-title">
            <div className="row">
              <div className="col-sm-2">
                <h2>
                  Questions <b></b>
                </h2>
              </div>
              <div className="col-sm-7">
                <button className="btn btn-primary" onClick={() => Inertia.visit('/add')}>
                  Add
                </button>
              </div>
            </div>
          </div>
          <table className="table table-striped table-hover table-bordered">
            <thead>
              <tr>
                <th className="col-sm-1">No.</th>
                <th className="col-sm-9">Question</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              {questions.length > 0 ? (
                questions.map((ques, i) => (
                  <tr key={ques.id}>
                    <td>{i + 1}</td>
                    <td>{ques.question}</td>
                    <td>
                      <button
                        type="button"
                        className="btn btn-danger delete"
                        data-toggle="modal"
                        data-target="#myModal"
                        onClick={() => deleteQuestion(ques.id)}
                      >
                        Delete
                      </button>
                    </td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan="3">Questions and Answers are not set</td>
                </tr>
              )}
            </tbody>
          </table>
          <div>
            <button className="btn btn-primary" onClick={() => Inertia.visit('/dashboard')}>
              Return to Dashboard
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Questions;
