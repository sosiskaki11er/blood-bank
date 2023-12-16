import React from 'react'
import ArrowsIcon from '../assets/icons/Arrows.svg'
import TableRow from './HistoryRow'

function History() {
  return (
    <div className='component'>
        <h3>History</h3>

        <div className='table'>
          <div className='table-header'>
            <div className='w-[120px]'>
              <h4>Date</h4>
              <img src={ArrowsIcon}/>
            </div>
            <div className='w-[120px]'>
              <h4>Time</h4>
              <img src={ArrowsIcon}/>
            </div>
            <div className='w-[160px]'>
              <h4>Status</h4>
              <img src={ArrowsIcon}/>
            </div>
            <div className='w-[200px]'>
              <h4>Hospital name</h4>
              <img src={ArrowsIcon}/>
            </div>
            <div className='w-[160px]'>
              <h4>Action performed</h4>
            </div>
          </div>

          <TableRow/>
          <TableRow/>
          <TableRow/>
        </div>

        <button className='see-more'>See more</button>
    </div>
  )
}

export default History