import React from 'react'
import Notification from './Notification'

function Notifications() {
  return (
    <div className='subpage'>
      <div className='component'>
        <h3>Recent notifications</h3>

        <div className='container flex-col gap-[16px]'>
          <Notification/>
          <Notification/>
          <Notification/>
          <Notification/>
          <Notification/>
          <Notification/>
        </div>
      </div>
    </div>
  )
}

export default Notifications