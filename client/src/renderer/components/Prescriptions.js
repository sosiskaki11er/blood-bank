import React from 'react'
import Requests from './Requests'

function Prescriptions({setSubpage}) {
  return (
    <div className='subpage'>
        <Requests setSubpage={setSubpage}/>
    </div>
  )
}

export default Prescriptions