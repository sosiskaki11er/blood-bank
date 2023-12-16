import React from 'react'
import ArrowsIcon from '../assets/icons/Arrows.svg'
import RequestsRow from './RequestsRow'

function Requests({setSubpage}) {
  return (
    <div className='component'>
    <h3>Prescription requests</h3>

    <div className='table'>
      <div className='table-header'>
        <div className='w-[120px]'>
          <h4>ID</h4>
          <img src={ArrowsIcon}/>
        </div>
        <div className='w-[200px]'>
          <h4>Patient’s name</h4>
          <img src={ArrowsIcon}/>
        </div>
        <div className='w-[120px]'>
          <h4>Date</h4>
          <img src={ArrowsIcon}/>
        </div>
        <div className='w-[80px]'>
          <h4>Time</h4>
          <img src={ArrowsIcon}/>
        </div>
        <div className='w-[120px]'>
          <h4>Status</h4>
          <img src={ArrowsIcon}/>
        </div>
        <div className='w-[100px]'>
          <h4>Action</h4>
        </div>
      </div>
    </div>

    <RequestsRow setSubpage={setSubpage}/>
    <RequestsRow setSubpage={setSubpage}/>
    <RequestsRow setSubpage={setSubpage}/>
    <RequestsRow setSubpage={setSubpage}/>

    <button className='see-more'>See more</button>
</div>
  )
}

export default Requests