import React from 'react'

function Blood({blood}) {
  return (
    <div className='blood'>
        <h1>{blood.blood_type}</h1>
        <div className='blood-amount'>
            <h3 className='font-bold'>{`${Number(blood.amount)/1000} L`}</h3>
        </div>
    </div>
  )
}

export default Blood