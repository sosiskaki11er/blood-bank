import React from 'react'
import Blood from './Blood'

function BloodAvailable() {
  return (
    <div className='component'>
        <h3>Blood available:</h3>

        <div className='container flex-wrap gap-[8px]'>
          <Blood/>
          <Blood/>
          <Blood/>
          <Blood/>
          <Blood/>
          <Blood/>
          <Blood/>
          <Blood/>
        </div>
    </div>
  )
}

export default BloodAvailable