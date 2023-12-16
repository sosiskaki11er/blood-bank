import React from 'react'

function HistoryRow() {
  return (
<div className='table-row'>
            <div className='w-[120px]'>
              <h4>28.10.2023</h4>
            </div>
            <div className='w-[120px]'>
              <h4>16:25</h4>
            </div>
            <div className='w-[160px]'>
              <h4>
                <div className='container gap-[8px]'>
                    <div className='indicator approve'/>
                    <h3 className='text-base'>Successful</h3>
                </div>
              </h4>
            </div>
            <div className='w-[200px]'>
              <h4>Haemalab-#1</h4>
            </div>
            <div className='w-[160px]'>
              <h4>Transfusion</h4>
            </div>
</div>
  )
}

export default HistoryRow