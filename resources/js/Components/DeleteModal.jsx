import React from 'react';
import PropTypes from 'prop-types';

const DeleteModal = ({ id, handleDelete }) => {
  const handleSubmit = (e) => {
    e.preventDefault();
    handleDelete(id);
  };

  return (
    <>
      <button type="button" className="btn btn-danger" data-toggle="modal" data-target={`#myModal${id}`}>
        Delete
      </button>
      <div className="modal fade" id={`myModal${id}`} tabIndex="-1" role="dialog">
        <div className="modal-dialog" role="document">
          <div className="modal-content">
            <div className="modal-header">
              <h4 className="modal-title">Delete Question</h4>
              <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form onSubmit={handleSubmit}>
              <div className="modal-body">
                <input type="hidden" name="id" value={id} />
                <p>Are you sure you want to delete this question?</p>
              </div>
              <div className="modal-footer">
                <button type="button" className="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" className="btn btn-danger">Delete</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </>
  );
};

DeleteModal.propTypes = {
  id: PropTypes.number.isRequired,
  handleDelete: PropTypes.func.isRequired,
};

export default DeleteModal;
